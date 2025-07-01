<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MonitoringGizi extends Controller
{
    public function index(){
        $loggedInUserId = Session::get('user_id'); // Mengambil ID dari sesi (simulasi)
        // Atau jika Anda ingin menguji dengan ID tertentu:
        // $loggedInUserId = 318320; // Contoh ID yang akan difilter

        if (!$loggedInUserId) {
            // Opsional: berikan pesan error atau arahkan ke login jika tidak ada user ID
            Session::flash('error', 'Anda harus login untuk melihat dashboard.');;
        }
        return view('monitoringgizi');
    }
}
