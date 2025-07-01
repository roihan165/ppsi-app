<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\RekomendasiMenuSehat;
use App\Http\Controllers\MonitoringGizi;
use App\Http\Controllers\Login;
use App\Http\Controllers\Register;
use App\Http\Controllers\Chart;
use App\Http\Controllers\selfCheckingController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\TentangKamiController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');

Route::get('/test-email', function () {
    try {
        Mail::raw('Ini email percobaan dari Brevo dan Laravel!', function ($message) {
            $message->to('muhammadroihan924@gmail.com')
                    ->subject('Tes Email Laravel + Brevo');
        });
        return 'Email dikirim!';
    } catch (\Exception $e) {
        return '❌ Gagal mengirim email: ' . $e->getMessage();
    }
});

// Route::get('/', function () {
//     return 'Laravel berhasil jalan di Railway!';
// });


Route::get('/', [Dashboard::class, 'index'])->name('dashboard');

Route::get('/tentangKami',[TentangKamiController::class,'index'])->name('tentangKami');

Route::get('/rekomendasimenusehat', [RekomendasiMenuSehat::class, 'index']);

Route::get('/profileAnak', [AnakController::class, 'index'])->name('anak.create');
Route::post('/anakAdd', [AnakController::class, 'store']);

Route::get('/monitoringPertumbuhan',[MonitoringGizi::class,'index'])->name('monitoring.guest');


Route::get('/login',[Login::class,'index'])->name('login')->middleware('guest');
Route::post('/login', [Login::class, 'login']);

Route::get('/register',[Register::class,'index'])->name('register')->middleware('guest');
Route::post('/userAdd',[Register::class,'store']);

Route::post('/logout', [Login::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/self-checking', [SelfCheckingController::class, 'showForm'])->name('selfChecking.form');

Route::middleware('auth')->group(function () {
    Route::post('/self-checking/save', [SelfCheckingController::class, 'save'])->name('selfChecking.save');
    Route::get('/self-checking/history', [SelfCheckingController::class, 'showHistory'])->name('selfChecking.history');
    Route::get('/api/self-checking/history', [SelfCheckingController::class, 'historyApi'])->name('selfChecking.api');
});

// Route::get('/userChart/{childId}', function($childId){
//     return view('user_chart',['childId'=>$childId]);
// });


// Route::get('/', [UserDataController::class, 'index']);
// Route::post('/store', [UserDataController::class, 'store']);
// Route::get('/edit/{id}', [UserDataController::class, 'edit']);
// Route::post('/update/{id}', [UserDataController::class, 'update']);
// Route::get('/delete/{id}', [UserDataController::class, 'destroy']);

// Route::get('/tableau', function () {
//     return view('tableu');
// });

// Route::get('/monitoringPertumbuhan', [SheetController::class, 'showCombinedMonitoring'])->name('monitoring.pertumbuhan'); // Untuk menampilkan formulir
Route::get('/monitoringPertumbuhan/{anak_NIK?}', [SheetController::class, 'showCombinedMonitoring'])
    ->name('monitoring.pertumbuhan'); // Pastikan hanya pengguna login yang bisa mengakses

Route::post('/submit-data', [SheetController::class, 'submitToGoogleSheet'])->name('submit.data')->middleware('auth');