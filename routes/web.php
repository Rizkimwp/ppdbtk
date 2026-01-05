<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PernyataanController;
use App\Models\Gelombang;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\GelombangController;
use App\Http\Controllers\ListBerkasController;
use App\Http\Controllers\PembayaranController;

Route::get('/', function() {
    $tahunAjaran = TahunAjaran::current();
    $gelombang = Gelombang::current();
    $hasOpen = $tahunAjaran && $gelombang;
    return view('landing-page', compact('tahunAjaran', 'gelombang', 'hasOpen'));
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
// Route::get('/login-sso', [AuthController::class, 'loginsso'])->name('loginsso');
Route::post('/login', [AuthController::class, 'login'])->name('loginpost');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showregister'])->name('register');
Route::post('/register', [AuthController::class, 'registerSiswa'])->name('registerSiswa');



Route::middleware(['auth:sanctum'])->group(function () {
    // Rute khusus user
    Route::get('/dashboard', [DashboardController::class, 'siswa'])->name('dashboard');
    Route::resource('calon-siswa', SiswaController::class);
    Route::get('pembayaran-siswa', [PembayaranController::class, 'pembayaranSiswa'])->name('pembayaranSiswa');
    Route::post('uploadbukti', [PembayaranController::class, 'uploadsiswa'])->name('uploadbukti');
    Route::post('uploadUlangBukti', [PembayaranController::class, 'uploadUlangPembayaran'])->name('uploadUlangPembayaran');
    Route::get('/notifications', [SiswaController::class, 'getNotifications']);
    Route::get('/notifications/read/{id}', [SiswaController::class, 'readNotifikasi'])->name('notifications.read');
    Route::post('/berkas/upload-ulang/{id}', [BerkasController::class, 'uploadUlang'])->name('berkas.upload_ulang');
});


Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    // Rute khusus user
    Route::prefix('pernyataan')->group(function () {
        Route::get('/', [PernyataanController::class, 'index'])->name('pernyataan.index');
        Route::post('/', [PernyataanController::class, 'store'])->name('pernyataan.store');
        Route::put('/{pernyataan}', [PernyataanController::class, 'update'])->name('pernyataan.update');
        Route::delete('/{pernyataan}', [PernyataanController::class, 'destroy'])->name('pernyataan.destroy');
    });


    Route::prefix('gelombang')->name('gelombang.')->group(function () {
        // List semua gelombang
        Route::get('/', [GelombangController::class, 'index'])->name('index');
        // Simpan data baru
        Route::post('/', [GelombangController::class, 'store'])->name('store');
        // Update gelombang
        Route::put('/{id}', [GelombangController::class, 'update'])->name('update');
        // Hapus gelombang
        Route::delete('/{id}', [GelombangController::class, 'destroy'])->name('destroy');

    });

    Route::get('/dashboard-admin', [DashboardController::class, 'admin'])->name('dashboard-admin');
    Route::post('change-password/{id}', [UserController::class, 'changePassword'])->name('user.change_password');
    Route::resource('tahun-ajaran', TahunController::class);

    Route::resource('kelas', KelasController::class);
    Route::resource('ruangan', RuanganController::class);
    Route::get('/generate-ruang-pdf', [RuanganController::class, 'generateRuang'])->name('cetakcalonsiswa');
    Route::resource('list-berkas', ListBerkasController::class);
    Route::put('validasi-berkas/{id}', [BerkasController::class, 'update'])->name('validasi-berkas.update');
    Route::get('validasi-berkas', [BerkasController::class, 'index'])->name('validasi-berkas.index');
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('findBerkas', [ListBerkasController::class, 'findById'])->name('listberkas');
    Route::resource('user', UserController::class);
// routes/web.php or routes/api.php
    Route::get('/siswa-by-kelas/{id}', [RuanganController::class, 'findSiswaByKelas']);

});