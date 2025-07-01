<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:user_webs,email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $data = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$data || Carbon::parse($data->created_at)->addMinutes(60)->isPast()) {
            return back()->withErrors(['token' => 'Token tidak valid atau sudah kadaluarsa.']);
        }

        DB::table('user_webs')->where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect('/login')->with('status', 'Password berhasil diubah.');
    }
}
