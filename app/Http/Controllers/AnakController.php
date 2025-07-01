<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Anak;

class AnakController extends Controller
{
    public function index() {
        $anaks = Anak::all();
        return view('profileanak',compact('anaks'));
    }

    public function store(Request $request)
    {
        // ... (validasi data anak) ...
        $request->validate([
            'anak_NIK' => ['required', 'string', 'digits:16', 'unique:anak'],
            'name' => ['required', 'string', 'max:255'],
            'tanggalLahir' => ['required','date'],
            'jenisKelamin' => ['required','numeric'],
            'usia' => ['required','numeric'],
        ]);

        // Mendapatkan NIK dari pengguna yang sedang login
        $userNik = Auth::user()->nik; // Asumsikan user yang login punya NIK

        // Simpan data anak, termasuk NIK pengguna
        Anak::create(array_merge($request->all(), [
            'user_nik' => $userNik,
        ]));

        return redirect('/profileAnak')->with('success', 'Data anak berhasil ditambahkan!');
    }
}
