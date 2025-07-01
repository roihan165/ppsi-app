<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SelfCheckingResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Anak; // Import model Anak Anda
use App\Models\UserWebs; // Import model UserWebs Anda (jika nama modelnya ini)

class SelfCheckingController extends Controller
{
    /**
     * Tampilkan form self-checking.
     * Ini adalah metode contoh untuk me-render view.
     */
    public function showForm()
    {
        // Pastikan pengguna login sebelum mengakses halaman ini
        if (!Auth::check()) {
            // Redirect atau tampilkan error jika tidak login
            return view('selfChecking');
        }

        // Dapatkan anak-anak yang dimiliki oleh user yang sedang login
        $anaks = Auth::user()->anaks; 
        // dd($anaks);
        // Kirim data anak ke view
        return view('selfChecking', compact('anaks'));
    }

    /**
     * Simpan hasil self-checking baru.
     */
    public function save(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Kamu belum login (auth check gagal)',
            ], 401);
        }


        // dd(Auth::check(), Auth::id(), Auth::user());
        // 1. Validasi Data Masukan
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'anak_nik' => 'required|string|max:255',
            'childAgeMonths' => 'required|numeric|min:0',
            'results' => 'required|array',
            'results.*.milestoneId' => 'required|string',
            'results.*.achieved' => 'required|boolean',
            'results.*.evaluation' => 'required|string',
            'results.*.message' => 'required|string',
            'overallStatus' => 'required|string|in:good,warning,danger',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422); // Unprocessable Entity
        }

        // dd($request->result);

        try {
            // 2. Simpan Data ke Database
            $result = SelfCheckingResult::create([
                'anak_nik' => $request->anak_nik,
                'child_age_months' => $request->childAgeMonths,
                'milestone_results' => $request->results, // Laravel akan otomatis meng-encode ke JSON
                'overall_status' => $request->overallStatus,
                'user_id' => Auth::id(),
            ]);

            // 3. Beri Respon Sukses
            return response()->json([
                'message' => 'Data self-checking berhasil disimpan!',
                'data' => $result
            ], 201); // Created
        } catch (\Exception $e) {
            // 4. Tangani Error
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data.',
                'error' => $e->getMessage()
            ], 500); // Internal Server Error
        }
    }

    /**
     * Tampilkan halaman riwayat self-checking.
     * Ini adalah metode contoh untuk me-render view riwayat.
     */
    public function showHistory()
    {
        // Pastikan pengguna login sebelum mengakses halaman ini
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login untuk melihat riwayat.');
        }
        $userNik = auth()->user()->nik;
        $anak = Anak::where('user_nik', $userNik)->get();

        return view('selfCheckingHistory',compact('anak'));
    }

    /**
     * Dapatkan riwayat self-checking untuk pengguna yang login. (API Endpoint)
     */
    public function historyApi()
    {
        // Pastikan pengguna login
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            // Eager load relasi 'anak' dan 'userWebs' untuk mengambil nama anak dan NIK user
            // Menggunakan nama relasi yang didefinisikan di model SelfCheckingResult
            $history = Auth::user()->selfCheckingResults()
                            ->with(['anak', 'userWebs'])
                            ->latest()
                            ->get();

            return response()->json([
                'message' => 'Riwayat self-checking berhasil diambil.',
                'data' => $history
            ], 200); // OK
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengambil riwayat self-checking.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}