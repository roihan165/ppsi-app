<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\RekomendasiMenuSehat;
use App\Http\Controllers\MonitoringGizi;
use App\Http\Controllers\Login;
use App\Http\Controllers\Register;
use App\Http\Controllers\Chart;
use App\Http\Controllers\Dashboard;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Route::get('/dashboard',[Dashboard::class, 'index']);
Route::get('/rekomendasimenusehat', [RekomendasiMenuSehat::class, 'index']);
Route::get('/monitoringPertumbuhan',[MonitoringGizi::class,'index']);
Route::get('/login',[Login::class,'index']);
Route::get('/register',[Register::class,'index']);
Route::post('/userAdd',[Register::class,'store']);

Route::get('/userChart/{childId}', function($childId){
    return view('user_chart',['childId'=>$childId]);
});


Route::get('/', [UserDataController::class, 'index']);
Route::post('/store', [UserDataController::class, 'store']);
Route::get('/edit/{id}', [UserDataController::class, 'edit']);
Route::post('/update/{id}', [UserDataController::class, 'update']);
Route::get('/delete/{id}', [UserDataController::class, 'destroy']);
