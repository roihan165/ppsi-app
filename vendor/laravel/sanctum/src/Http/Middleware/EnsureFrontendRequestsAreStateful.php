<?php

namespace Laravel\Sanctum\Http\Middleware;

use Illuminate\Routing\Pipeline;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class EnsureFrontendRequestsAreStateful
{
    /**
     * Handle the incoming requests.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  callable  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        // --- SISIPKAN DD() DI SINI, DI BARIS PERTAMA METODE HANDLE ---
        dd([
            'request_url' => $request->fullUrl(),
            'referer_domain' => parse_url($request->headers->get('referer'))['host'] ?? null,
            'is_in_stateful_domains' => $this->inStatefulDomains($request->url()) || $this->inStatefulDomains($request->headers->get('referer')),
            'has_session' => $request->hasSession(), // Apakah request ini memiliki sesi?
            'session_id' => $request->hasSession() ? $request->session()->getId() : 'N/A', // ID sesi
            'session_data_all' => $request->hasSession() ? session()->all() : 'N/A', // Data sesi lengkap
            'is_authenticated_via_session_guard' => Auth::guard('web')->check(), // Apakah guard 'web' terautentikasi?
            'cookie_header' => $request->headers->get('Cookie'), // Cookie yang diterima server
            'xsrf_token_header' => $request->headers->get('X-XSRF-TOKEN'), // XSRF Token Header yang diterima server
        ]);
        $this->configureSecureCookieSessions();

        return (new Pipeline(app()))->send($request)->through(
            static::fromFrontend($request) ? $this->frontendMiddleware() : []
        )->then(function ($request) use ($next) {
            return $next($request);
        });
    }

    /**
     * Configure secure cookie sessions.
     *
     * @return void
     */
    protected function configureSecureCookieSessions()
    {
        config([
            'session.http_only' => true,
            'session.same_site' => 'lax',
        ]);
    }

    /**
     * Get the middleware that should be applied to requests from the "frontend".
     *
     * @return array
     */
    protected function frontendMiddleware()
    {
        $middleware = array_values(array_filter(array_unique([
            config('sanctum.middleware.encrypt_cookies', \Illuminate\Cookie\Middleware\EncryptCookies::class),
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            config('sanctum.middleware.validate_csrf_token'),
            config('sanctum.middleware.verify_csrf_token', \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class),
            config('sanctum.middleware.authenticate_session'),
        ])));

        array_unshift($middleware, function ($request, $next) {
            $request->attributes->set('sanctum', true);

            return $next($request);
        });

        return $middleware;
    }

    /**
     * Determine if the given request is from the first-party application frontend.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public static function fromFrontend($request)
    {
        $domain = $request->headers->get('referer') ?: $request->headers->get('origin');

        if (is_null($domain)) {
            return false;
        }

        $domain = Str::replaceFirst('https://', '', $domain);
        $domain = Str::replaceFirst('http://', '', $domain);
        $domain = Str::endsWith($domain, '/') ? $domain : "{$domain}/";

        $stateful = array_filter(config('sanctum.stateful', []));

        return Str::is(Collection::make($stateful)->map(function ($uri) {
            return trim($uri).'/*';
        })->all(), $domain);
    }
}
