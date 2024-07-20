<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\GelombangController;
use App\Http\Controllers\ListBerkasController;
use App\Http\Controllers\PembayaranController;

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

Route::resource('tahun-ajaran', TahunController::class);
Route::resource('gelombang', GelombangController::class);
Route::resource('calon-siswa', SiswaController::class);
Route::resource('list-berkas', ListBerkasController::class);
Route::resource('validasi-berkas', BerkasController::class);
Route::resource('pembayaran', PembayaranController::class);
Route::get('findBerkas', [ListBerkasController::class, 'findById'])->name('listberkas');
Route::resource('user', UserController::class);