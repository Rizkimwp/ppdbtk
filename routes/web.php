<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\GelombangController;
use App\Http\Controllers\ListBerkasController;
use App\Http\Controllers\PembayaranController;


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/login-sso', [AuthController::class, 'loginsso'])->name('loginsso');
Route::post('/login', [AuthController::class, 'login'])->name('loginpost');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showregister'])->name('register');
Route::post('/register', [AuthController::class, 'registerSiswa'])->name('registerSiswa');


Route::middleware(['auth:sanctum'])->group(function () {
    // Rute khusus user
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
    Route::resource('calon-siswa', SiswaController::class);
    Route::get('pembayaran-siswa', [PembayaranController::class, 'pembayaranSiswa'])->name('pembayaranSiswa');
    Route::put('uploadbukti/{id}', [PembayaranController::class, 'uploadsiswa'])->name('uploadbukti');

});


Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    // Rute khusus user

    Route::resource('tahun-ajaran', TahunController::class);
    // Route::resource('gelombang', GelombangController::class);
    Route::resource('list-berkas', ListBerkasController::class);
    Route::resource('validasi-berkas', BerkasController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('findBerkas', [ListBerkasController::class, 'findById'])->name('listberkas');
    Route::resource('user', UserController::class);

});
