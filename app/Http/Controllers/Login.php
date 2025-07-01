<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\UserWeb;

class Login extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

         // --- DEBUGGING LOGIN ---
        // $user = UserWeb::where('email', $credentials['email'])->first();

        // dd(
        //     'Credentials Received (from form):', $credentials,
        //     'User Retrieved from DB (should be UserWeb object):', $user,
        //     'Is User Found:', (bool)$user, // true jika ditemukan, false jika null
        //     'Password from DB (should be hashed):', $user ? $user->password : 'N/A (User not found)',
        //     'Plain password from request:', $credentials['password'],
        //     'Hash::check Result (should be TRUE if password matches):',
        //     $user ? Hash::check($credentials['password'], $user->password) : 'N/A (User not found)'
        // );
        // // --- AKHIR DEBUGGING LOGIN ---
        $anak = null;
        $user_NIK = Auth::user();
        if ($user_NIK) {
            // Ambil data anak berdasarkan anak_NIK
            // Pastikan anak tersebut milik user yang sedang login untuk keamanan
            if (Auth::check()) {
                $user = Auth::user();
                // Gunakan relasi anaks() untuk memastikan anak ini milik user yang login
                $anak = $user->anaks()->where('anak_NIK', $user_NIK)->first();
            }
        }
        // Coba panggil Auth::attempt() di dalam try-catch
        try {
            if (Auth::attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();
                return redirect()->intended('/')->with([
                    'success' => 'Logged in successfully!',
                    'anak' => $anak, 
                ]);
            }
        } catch (\Throwable $e) {
            // Jika terjadi pengecualian saat Auth::attempt(), tampilkan detailnya
            dd('Error during Auth::attempt():', $e->getMessage(), $e->getFile(), $e->getLine());
        }


        // Jika Auth::attempt() mengembalikan false (dan tidak ada exception)
        throw ValidationException::withMessages([
            'email' => ['Email atau Password yang Anda masukkan Salah!!!'],
        ]);
    
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully!');
    }
}
