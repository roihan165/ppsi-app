<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
            $encoded = env('GOOGLE_APPLICATION_CREDENTIALS_BASE64');
    
            if ($encoded) {
                $path = storage_path('app/google-service-account.json');
                if (!file_exists($path)) {
                    file_put_contents($path, base64_decode($encoded));
                    \Log::info('Google credentials file written to: ' . $path);
                }
            } else {
                \Log::error('Missing GOOGLE_APPLICATION_CREDENTIALS_BASE64 env variable');
            }
        }
        
    }
}
