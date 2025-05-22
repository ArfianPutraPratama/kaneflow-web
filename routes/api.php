<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;

Route::post('/login', [AuthController::class, 'apiLogin'])->name('api.login');
Route::post('/register', [AuthController::class, 'apiRegister'])->name('api.register');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [AuthController::class, 'getRegisteredUsers']);
    Route::get('/me', [AuthController::class, 'getAuthenticatedUser']);
    Route::post('/pemasukan', [TransaksiController::class, 'pemasukanStore'])->name('api.pemasukan.store');
    Route::get('/pemasukan', [TransaksiController::class, 'pemasukanTabel'])->name('api.pemasukan.tabel');
    Route::get('/pemasukan/{id}', [TransaksiController::class, 'detailPemasukan'])->name('api.pemasukan.detail');
    Route::delete('/pemasukan/{id}', [TransaksiController::class, 'deletePemasukan'])->name('api.pemasukan.delete');

    // Add this new route for pengeluaran
    Route::post('/pengeluaran', [TransaksiController::class, 'pengeluaranStore'])->name('api.pengeluaran.store');
    Route::get('/pengeluaran', [TransaksiController::class, 'pengeluaranTabel'])->name('api.pengeluaran.tabel');
    Route::delete('/pengeluaran/{id}', [TransaksiController::class, 'deletePengeluaran'])->name('api.pengeluaran.delete');

    Route::get('/register', [AuthController::class, 'getRegisteredUsers'])->name('api.register.get');
    Route::get('/login', [AuthController::class, 'getAuthenticatedUser'])->name('api.login.get');
    // untuk dashboard
    Route::get('/dashboard', [DashboardController::class, 'apiIndex'])->name('api.dashboard');
    Route::get('/laporan/kas', [LaporanController::class, 'apiKas'])->name('api.laporan.kas');
    Route::get('/laporan/pemasukan', [LaporanController::class, 'apiPemasukan'])->name('api.laporan.pemasukan');
    Route::get('/laporan/pengeluaran', [LaporanController::class, 'apiPengeluaran'])->name('api.laporan.pengeluaran');

    // New API routes for ProfilController
    Route::get('/profil/{id?}', [ProfilController::class, 'apiProfil'])->name('api.profil');
    Route::get('/profil/ubah', [ProfilController::class, 'apiUbahProfil'])->name('api.profil.ubah');
    Route::post('/profil/update/{id?}', [ProfilController::class, 'apiUpdate'])->name('api.profil.update');
});
