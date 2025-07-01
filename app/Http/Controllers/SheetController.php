<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Google\Service\Sheets\ValueRange; // <-- Penting: Tambahkan ini
use Illuminate\Support\Facades\Auth;
use App\Models\Anak;
use App\Models\UserWeb;

class SheetController extends Controller
{
    public function index()
    {
        // Tidak perlu lagi cek status otentikasi, karena ini menggunakan Service Account
        return view('monitoringgizi', ['is_authenticated' => true]); // Anggap selalu terotentikasi
    }

    public function showLookerStudioDashboard()
    {
        // 1. Ambil ID Pengguna yang Sedang Login dari Aplikasi Laravel Anda
        // GANTI DENGAN Auth::id() JIKA ANDA MENGGUNAKAN SISTEM AUTENTIKASI LARAVEL YANG SEBENARNYA
        $loggedInUserId = Session::get('user_id'); // Mengambil ID dari sesi (simulasi)
        // Atau jika Anda ingin menguji dengan ID tertentu:
        // $loggedInUserId = 318320; // Contoh ID yang akan difilter

        if (!$loggedInUserId) {
            return redirect('/')->with('error', 'Silakan login terlebih dahulu untuk melihat dashboard.');
        }

        // 2. Dapatkan URL Embed Dasar dari .env
        $baseEmbedUrl = env('LOOKER_STUDIO_BASE_EMBED_URL');

        // 3. Siapkan Parameter Filter Looker Studio
        $filterParamId = env('LOOKER_STUDIO_FILTER_PARAM_ID'); // 'df4'
        $filterValuePrefix = env('LOOKER_STUDIO_FILTER_VALUE_PREFIX'); // 'include%EE%80%800%EE%80%80EQ%EE%80%80'

        // Gabungkan prefix dengan ID pengguna yang login untuk membentuk string filter lengkap
        // Pastikan ID pengguna juga di-urlencode jika mengandung karakter khusus
        $fullFilterValueString = $filterValuePrefix . urlencode($loggedInUserId);

        // Buat array PHP untuk params
        $paramsArray = [
            $filterParamId => $fullFilterValueString,
        ];

        // 4. Encode Parameter Menjadi String JSON dan Kemudian URL-Encode
        // json_encode akan mengubah array PHP menjadi string JSON: {"df4":"include%EE%80%800%EE%80%80EQ%EE%80%80318320"}
        // urlencode akan mengubah string JSON menjadi format yang aman untuk URL
        $encodedParams = urlencode(json_encode($paramsArray));

        // 5. Gabungkan URL Dasar dengan Parameter Filter
        $finalEmbedUrl = $baseEmbedUrl . '?params=' . $encodedParams;

        // 6. Teruskan URL ke View untuk Disematkan
        return view('looker_studio_dashboard', compact('finalEmbedUrl'));
    }

    public function showCombinedMonitoring(Request $request,$anak_NIK = null)
    {

        $anak = null;
        if ($anak_NIK) {
            // Ambil data anak berdasarkan anak_NIK
            // Pastikan anak tersebut milik user yang sedang login untuk keamanan
            if (Auth::check()) {
                $user = Auth::user();
                // Gunakan relasi anaks() untuk memastikan anak ini milik user yang login
                $anak = $user->anaks()->where('anak_NIK', $anak_NIK)->first();

                // Jika tidak ditemukan atau bukan milik user yang login
                if (!$anak) {
                    return redirect('/monitoringPertumbuhan')->with('error', 'Data anak tidak ditemukan atau Anda tidak memiliki akses.');
                }
            } else {
                // Jika tidak login, redirect ke login atau tampilkan pesan error
                return redirect('/login')->with('error', 'Anda harus login untuk mengakses data ini.');
            }
        }

        // Logika untuk mempersiapkan form (dari fungsi index Anda)
        // Anda bisa langsung membuat array untuk data view form
        $formData = [
            // Anda bisa mengisi nilai 'old' jika formnya diproses di halaman yang sama,
            // tapi karena submit form terpisah (POST), ini mungkin tidak terlalu relevan di sini.
            'nama' => old('nama'),
            'jenis_kelamin' => old('jenis_kelamin'),
            'usia' => old('usia'),
            'panjang' => old('panjang'),
            'tinggi' => old('tinggi'),
            'berat' => old('berat'),
            'daymonth' => old('daymonth'),
        ];

        // Logika untuk mendapatkan URL embed Looker Studio (dari fungsi showLookerStudioDashboard Anda)
        $finalEmbedUrl = null; // Inisialisasi null
        $loggedInUserId = $anak_NIK; // Ambil ID pengguna

        if ($loggedInUserId) {
            $baseEmbedUrl = env('LOOKER_STUDIO_BASE_EMBED_URL');
            $filterParamId = env('LOOKER_STUDIO_FILTER_PARAM_ID');
            $filterValuePrefix = env('LOOKER_STUDIO_FILTER_VALUE_PREFIX');

            $fullFilterValueString = $filterValuePrefix . urlencode($loggedInUserId);
            $paramsArray = [$filterParamId => $fullFilterValueString];
            $encodedParams = urlencode(json_encode($paramsArray));

            $finalEmbedUrl = $baseEmbedUrl . '?params=' . $encodedParams;
        } else {
            // Opsional: berikan pesan error atau arahkan ke login jika tidak ada user ID
            Session::flash('error', 'Anda harus login untuk melihat dashboard.');
        }


        // Meneruskan kedua jenis data ke satu view gabungan
        return view('monitoringgizi', compact('formData', 'finalEmbedUrl','anak'));
    }
    /**
     * Mengirim data dari formulir ke Google Sheet menggunakan Service Account.
     */
    public function submitToGoogleSheet(Request $request)
    {
        $anak_NIK = $request->input('anak_NIK');

        // Validasi input
        $request->validate([
            'anak_NIK' => 'required|string', // Tambahkan validasi untuk anak_NIK yang tersembunyi
            'nama' => 'required|string|max:255', // Sesuaikan dengan 'name' di form: nama_input='nama'
            'jenis_kelamin' => 'required|in:0,1', // Gunakan 'in' untuk enum 0/1
            'usia' => 'required|in:0,1',         // Gunakan 'in' untuk enum 0/1
            'panjang' => 'nullable|numeric',     // Buat nullable saja, karena required_if menangani 'required'
            'tinggi' => 'nullable|numeric',      // Buat nullable saja, karena required_if menangani 'required'
            'berat' => 'required|numeric',
            'daymonth' => 'required|date_format:Y-m', // Sesuaikan dengan input type="month" (YYYY-MM)
        ]);

        try {
            // Dengan Service Account, Anda tidak perlu memanggil Sheets::setAccessToken()
            // karena kredensial sudah dimuat dari config/google.php
            // (pastikan GOOGLE_SERVICE_ENABLED=true di .env dan file JSON benar)

            $tinggiAtauPanjang = $request->usia == '0' ? $request->panjang : $request->tinggi;
            $berat = $request->berat;
            $tanggal = $request->date('daymonth');

            // --- PENTING UNTUK INTERPRETASI TANGGAL DI SHEETS ---
            // Google Sheets paling baik menginterpretasikan tanggal dalam format 'YYYY-MM-DD'.
            // Jika Anda hanya ingin 'YYYY-MM' ditampilkan, formatlah sel di Google Sheets-nya.
            // Mengirim 'YYYY-MM' sebagai string ke API cenderung tetap dianggap string teks.
            $formattedDateForSheets = $tanggal->format('Y-m-d'); 
            // Contoh: Jika input '2025-06-20', maka akan dikirim '2025-06-20'
            // Contoh: Jika Anda ingin selalu tanggal 1 bulan itu: $tanggal->format('Y-m-01');

            // Data yang akan ditulis ke Google Sheet
            $dataRow = [ // Menggunakan nama variabel yang lebih jelas
                $anak_NIK,                             // anak_NIK dari hidden input
                $request->input('nama'),               // Gunakan input() untuk konsistensi
                $request->input('jenis_kelamin'),      // Gunakan input()
                $request->input('usia'),
                floatval($tinggiAtauPanjang),
                floatval($berat),
                $formattedDateForSheets, // Kirim tanggal dalam format YYYY-MM-DD
                // Carbon::now()->toDateTimeString(), // Timestamp saat ini jika diperlukan
            ];

            // Tentukan nama sheet (tab) dan ID Spreadsheet
            $sheetName = 'Sheet1'; // Ganti dengan nama sheet Anda yang benar
            $spreadsheetId = env('GOOGLE_SHEET_ID');

            // --- AWAL BAGIAN KRUSIAL UNTUK SOLUSI INI ---
            // Dapatkan instance layanan Google_Service_Sheets dari paket Revolution
            // Ini memberi Anda akses ke fungsionalitas API Sheets yang lebih granular
            $service = Sheets::getService();

            // Buat objek ValueRange untuk membungkus data yang akan ditambahkan
            // API Sheets mengharapkan array dari array untuk 'values'
            $body = new ValueRange([
                'values' => [$dataRow] // Kita hanya menambahkan satu baris data
            ]);

            // Tentukan parameter tambahan untuk permintaan API Sheets
            $params = [
                // Ini adalah parameter PALING PENTING.
                // Memberitahu Google Sheets untuk menginterpretasikan nilai seolah-olah
                // pengguna mengetiknya langsung. Ini memungkinkan Sheets mengenali tanggal.
                'valueInputOption' => 'USER_ENTERED' 
            ];

            // Tentukan rentang di mana data akan ditambahkan.
            // Untuk operasi 'append', Anda cukup menentukan rentang kolom,
            // dan API akan menemukan baris kosong berikutnya.
            $range = $sheetName . '!A:Z'; // Contoh: Dari kolom A sampai Z

            // Lakukan permintaan 'append' ke Google Sheets API
            $service->spreadsheets_values->append(
                $spreadsheetId,
                $range,
                $body,
                $params
            );
            // --- AKHIR BAGIAN KRUSIAL ---

            return back()->with('success', 'Data berhasil dikirim ke Google Sheets via Service Account!');
        } catch (\Exception $e) {
            // Tangani error, misalnya masalah izin atau ID spreadsheet
            // Anda bisa log error ini lebih lanjut untuk debugging
            // \Log::error('Error mengirim ke Google Sheets: ' . $e->getMessage()); 
            return back()->with('error', 'Gagal mengirim data: ' . $e->getMessage());
        }
    }
}