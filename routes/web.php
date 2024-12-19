<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManajemenPengguna\PeranHakAkses\HakAksesController;
use App\Http\Controllers\ManajemenPengguna\PeranHakAkses\PeranController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('manajemen-pengguna')->name('manajemen-pengguna.')->group(function () {
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
