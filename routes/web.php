<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/register', [LoginController::class, 'register']);
    Route::post('/register', [LoginController::class, 'registerProcess']);
    Route::post('/transaksi/hitung', [TransaksiController::class, 'hitung']);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('jenis-sampah', JenisController::class)->middleware('admin');
});
