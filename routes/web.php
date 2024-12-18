<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManajemenPengguna\PeranHakAkses\HakAksesController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('manajemen-pengguna')->name('manajemen-pengguna.')->group(function () {
    Route::prefix('peran-hak-akses')->name('peran-hak-akses.')->group(function () {
        Route::get('/hak-akses', [HakAksesController::class, 'index'])->name('hak-akses');
        Route::get('/hak-akses/{permission}', [HakAksesController::class, 'show'])->name('hak-akses.show');
        Route::post('/hak-akses', [HakAksesController::class, 'store'])->name('hak-akses.store');
        Route::put('/hak-akses/{permission}', [HakAksesController::class, 'update'])->name('hak-akses.update');
        Route::delete('/hak-akses/{permission}', [HakAksesController::class, 'destroy'])->name('hak-akses.destroy');
    });
});
