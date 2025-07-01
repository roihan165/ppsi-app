<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserWeb;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    public function index() {
        return view('register');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user_webs'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' checks for password_confirmation field
            'nik' => ['required', 'string', 'digits:16', 'unique:user_webs'],
        ]);
        // --- DEBUG POINT 1: What Laravel receives from the form ---
        // You should see the plain text password here (e.g., '12345678')
        // dd('Request Data:', $request->all());

        $user = $request->all();
        $user['password'] = Hash::make($request->password);
        $user = UserWeb::create($user);
        // Check the class to ensure it's your UserWeb model
        // Check the password value from the created object.
        // It should be the hashed value if Authenticatable worked.
        // dd(
        //     'Class of created object:', get_class($user),
        //     'Password directly from the $user object:', $user->password
        // );
        return redirect()->route('login')->with('success', 'Registration successfully.');
    }
}
