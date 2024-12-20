<?php

use App\Http\Controllers\Auth\DaftarController;
use App\Http\Controllers\Auth\MasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManajemenPengguna\PenggunaController;
use App\Http\Controllers\ManajemenPengguna\PeranHakAkses\HakAksesController;
use App\Http\Controllers\ManajemenPengguna\PeranHakAkses\PeranController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/masuk', [MasukController::class, 'index'])->name('masuk');
    Route::post('/masuk', [MasukController::class, 'authenticate'])->name('masuk.authenticate');

    Route::get('/daftar', [DaftarController::class, 'index'])->name('daftar');
    Route::post('/daftar', [DaftarController::class, 'store'])->name('daftar.store');
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('manajemen-pengguna')->name('manajemen-pengguna.')->group(function () {
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
    Route::get('/pengguna/{user}', [PenggunaController::class, 'show'])->name('pengguna.show');
    Route::post('/pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::put('/pengguna/{user}', [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{user}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
    Route::put('/pengguna/reset-password/{user}', [PenggunaController::class, 'resetPassword'])->name('peran.reset-password');

    Route::prefix('peran-hak-akses')->name('peran-hak-akses.')->group(function () {
        Route::get('/peran', [PeranController::class, 'index'])->name('peran');
        Route::get('/peran/{role}', [PeranController::class, 'show'])->name('peran.show');
        Route::post('/peran', [PeranController::class, 'store'])->name('peran.store');
        Route::put('/peran/{role}', [PeranController::class, 'update'])->name('peran.update');
        Route::delete('/peran/{role}', [PeranController::class, 'destroy'])->name('peran.destroy');
        Route::put('/peran/kelola-hak-akses/{role}', [PeranController::class, 'kelolaHakAkses'])->name('peran.kelola-hak-akses');

        Route::get('/hak-akses', [HakAksesController::class, 'index'])->name('hak-akses');
        Route::get('/hak-akses/{permission}', [HakAksesController::class, 'show'])->name('hak-akses.show');
        Route::post('/hak-akses', [HakAksesController::class, 'store'])->name('hak-akses.store');
        Route::put('/hak-akses/{permission}', [HakAksesController::class, 'update'])->name('hak-akses.update');
        Route::delete('/hak-akses/{permission}', [HakAksesController::class, 'destroy'])->name('hak-akses.destroy');
    });
});
