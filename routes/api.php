<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;

// Group API routes with optional CORS
Route::group(['middleware' => []], function () {
    // Authentication
    Route::post('/login', [AuthController::class, 'apiLogin'])->name('api.login');
    Route::post('/register', [AuthController::class, 'apiRegister'])->name('api.register');

    // Authenticated routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [AuthController::class, 'getAuthenticatedUser'])->name('api.user.me');
        Route::get('/users', [AuthController::class, 'getRegisteredUsers'])->name('api.users.index');

        // Transaksi routes
        Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('api.transaksi.store');
        Route::put('/transaksi/store/{id}', [TransaksiController::class, 'update'])->name('api.transaksi.update');
        Route::get('/transaksi', [TransaksiController::class, 'index'])->name('api.transaksi.index');

        // Transaksi
        Route::post('/pemasukan', [TransaksiController::class, 'pemasukanStore'])->name('api.pemasukan.store');
        Route::get('/pemasukan', [TransaksiController::class, 'pemasukanTabel'])->name('api.pemasukan.tabel');
        Route::get('/pemasukan/{id}', [TransaksiController::class, 'detailPemasukan'])->name('api.pemasukan.detail');
        Route::post('/pemasukan/{id}', [TransaksiController::class, 'updatePemasukan'])->name('api.pemasukan.update');
        Route::delete('/pemasukan/{id}', [TransaksiController::class, 'deletePemasukan'])->name('api.pemasukan.delete');

        Route::post('/pengeluaran', [TransaksiController::class, 'pengeluaranStore'])->name('api.pengeluaran.store');
        Route::get('/pengeluaran', [TransaksiController::class, 'pengeluaranTabel'])->name('api.pengeluaran.tabel');
        Route::post('/pengeluaran/{id}', [TransaksiController::class, 'updatePengeluaran'])->name('api.pengeluaran.update');
        Route::delete('/pengeluaran/{id}', [TransaksiController::class, 'deletePengeluaran'])->name('api.pengeluaran.delete');

        // Dashboard & Laporan
        Route::get('/dashboard', [DashboardController::class, 'apiIndex'])->name('api.dashboard');
        Route::get('/laporan/kas', [LaporanController::class, 'apiKas'])->name('api.laporan.kas');
        Route::get('/laporan/pemasukan', [LaporanController::class, 'apiPemasukan'])->name('api.laporan.pemasukan');
        Route::get('/laporan/pengeluaran', [LaporanController::class, 'apiPengeluaran'])->name('api.laporan.pengeluaran');

        // Profil
        Route::get('/profil', action: [ProfilController::class, 'apiProfil'])->name('api.profil.index');
        Route::post('/profil/{id}', action: [ProfilController::class, 'apiUpdate'])->name('api.profil.update');

        // Password Update
        Route::post('/password/update', [AuthController::class, 'apiUpdatePassword'])->name('api.password.update');
    });
});
