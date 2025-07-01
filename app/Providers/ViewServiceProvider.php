<?php
namespace App\Providers;

use Illuminate\Support\Facades\View; // Import Facade View
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth; // Import Facade Auth
use App\Models\Anak; // Import model Anak Anda
class ViewServiceProvider extends ServiceProvider
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
        // Menggunakan view composer untuk 'layout' atau semua view
        // Jika Anda ingin data ini tersedia di SEMUA view: View::share(...)
        // Jika hanya di layout Anda: View::composer('layout', function ($view) { ... });
        // Atau untuk beberapa view: View::composer(['layout', 'dashboard'], function ($view) { ... });
        View::composer('*', function ($view) { // Menggunakan '*' berarti data ini akan tersedia di SEMUA view
            $anaksData = collect(); // Koleksi kosong secara default untuk semua anak
            $selectedAnak = null;   // Objek anak yang dipilih secara default null

            if (Auth::check()) { // Hanya ambil data jika ada pengguna yang login
                $user = Auth::user();

                // 1. Ambil semua anak yang dimiliki user ini
                $anaksData = $user->anaks; // Menggunakan relasi hasMany

                // 2. Coba ambil anak yang dipilih dari session
                $selectedAnakNIK = session('selected_anak_NIK');

                if ($selectedAnakNIK) {
                    // Cari anak tersebut di antara anak-anak user yang login
                    // Penting untuk memastikan anak ini memang milik user yang login untuk keamanan
                    $selectedAnak = $anaksData->where('anak_NIK', $selectedAnakNIK)->first();

                    // Jika anak yang ada di session tidak ditemukan (mungkin dihapus atau bukan milik user)
                    if (!$selectedAnak) {
                        session()->forget('selected_anak_NIK');
                        session()->forget('selected_anak_name'); // Hapus juga nama jika ada
                    }
                }

                // Jika tidak ada anak yang dipilih, dan user punya anak,
                // maka secara otomatis pilih anak pertama sebagai default untuk kemudahan
                if (!$selectedAnak && $anaksData->isNotEmpty()) {
                    $selectedAnak = $anaksData->first();
                    session(['selected_anak_NIK' => $selectedAnak->anak_NIK]);
                    session(['selected_anak_name' => $selectedAnak->name]);
                }
            } else {
                // Jika tidak ada user login, pastikan data anak kosong
                session()->forget('selected_anak_NIK');
                session()->forget('selected_anak_name');
            }

            // Bagikan data ke semua view
            $view->with('anaksData', $anaksData);
            $view->with('selectedAnak', $selectedAnak); // <<< Ini variabel baru yang penting
        });
    }
}
    