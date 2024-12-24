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
    Route::get('/masuk', [MasukController::class, 'index'])->name('masuk')->middleware('guest');
    Route::post('/masuk', [MasukController::class, 'authenticate'])->name('masuk.authenticate')->middleware('guest');
    Route::post('/keluar', [MasukController::class, 'logout'])->name('masuk.logout')->middleware('auth');

    Route::get('/daftar', [DaftarController::class, 'index'])->name('daftar')->middleware('guest');
    Route::post('/daftar', [DaftarController::class, 'store'])->name('daftar.store')->middleware('guest');
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth', 'permission:dashboard');

Route::prefix('manajemen-pengguna')->name('manajemen-pengguna.')->middleware('auth')->group(function () {
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna')->middleware('permission:pengguna');
    Route::get('/pengguna/{user}', [PenggunaController::class, 'show'])->name('pengguna.show')->middleware('permission:pengguna.detail');
    Route::post('/pengguna', [PenggunaController::class, 'store'])->name('pengguna.store')->middleware('permission:pengguna.tambah');
    Route::put('/pengguna/{user}', [PenggunaController::class, 'update'])->name('pengguna.update')->middleware('permission:pengguna.ubah');
    Route::delete('/pengguna/{user}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy')->middleware('permission:pengguna.hapus');
    Route::put('/pengguna/reset-password/{user}', [PenggunaController::class, 'resetPassword'])->name('pengguna.reset-password')->middleware('permission:pengguna.reset-password');

    Route::prefix('peran-hak-akses')->name('peran-hak-akses.')->group(function () {
        Route::get('/peran', [PeranController::class, 'index'])->name('peran')->middleware('permission:peran');
        Route::get('/peran/{role}', [PeranController::class, 'show'])->name('peran.show')->middleware('permission:peran.detail');
        Route::post('/peran', [PeranController::class, 'store'])->name('peran.store')->middleware('permission:peran.tambah');
        Route::put('/peran/{role}', [PeranController::class, 'update'])->name('peran.update')->middleware('permission:peran.ubah');
        Route::delete('/peran/{role}', [PeranController::class, 'destroy'])->name('peran.destroy')->middleware('permission:peran.hapus');
        Route::put('/peran/kelola-hak-akses/{role}', [PeranController::class, 'kelolaHakAkses'])->name('peran.kelola-hak-akses')->middleware('permission:peran.kelola-hak-akses');

        Route::get('/hak-akses', [HakAksesController::class, 'index'])->name('hak-akses')->middleware('permission:hak-akses');
        Route::get('/hak-akses/{permission}', [HakAksesController::class, 'show'])->name('hak-akses.show')->middleware('permission:hak-akses.detail');
        Route::post('/hak-akses', [HakAksesController::class, 'store'])->name('hak-akses.store')->middleware('permission:hak-akses.tambah');
        Route::put('/hak-akses/{permission}', [HakAksesController::class, 'update'])->name('hak-akses.update')->middleware('permission:hak-akses.ubah');
        Route::delete('/hak-akses/{permission}', [HakAksesController::class, 'destroy'])->name('hak-akses.destroy')->middleware('permission:hak-akses.hapus');
    });
});
