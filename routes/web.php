<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReferensiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\ApiDocumentationController;
use App\Http\Controllers\Auth\FirebaseAuthController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::match(['get', 'post'], '/auth/firebase/callback', [FirebaseAuthController::class, 'handleFirebaseCallback'])->name('firebase.callback');
// Social Login Routes
Route::get('/login/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('/login/facebook', [AuthController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

// Forgot Password Route
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.forgot')->middleware('auth');

// Password Update Route
Route::post('/password/update', [AuthController::class, 'updatePassword'])->name('password.update')->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::get('/Dashboard', [DashboardController::class, 'index'])->name('Dashboard');
});

// Transaksi Routes
Route::get('/pemasukan', [TransaksiController::class, 'pemasukan'])->name('pemasukan')->middleware('auth');
Route::post('/pemasukan/store', [TransaksiController::class, 'pemasukanStore'])->name('pemasukan.store')->middleware('auth');
Route::get('/pengeluaran', [TransaksiController::class, 'pengeluaran'])->name('Pengeluaran')->middleware('auth');
Route::post('/pengeluaran/store', [TransaksiController::class, 'pengeluaranStore'])->name('pengeluaran.store')->middleware('auth');
Route::get('/pemasukan/tabel', [TransaksiController::class, 'pemasukanTabel'])->name('pemasukan.tabel')->middleware('auth');
Route::get('/pengeluaran/tabel', [TransaksiController::class, 'pengeluaranTabel'])->name('pengeluaran.tabel')->middleware('auth');
Route::delete('/pemasukan/delete/{id}', [TransaksiController::class, 'deletePemasukan'])->name('pemasukan.delete')->middleware('auth');
Route::delete('/pengeluaran/delete/{id}', [TransaksiController::class, 'deletePengeluaran'])->name('pengeluaran.delete')->middleware('auth');

// Profil Routes
Route::get('/profil', [ProfilController::class, 'profil'])->name('profil')->middleware('auth');
Route::get('/profil/ubah', [ProfilController::class, 'ubahProfil'])->name('profil.ubah')->middleware('auth');
Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update')->middleware('auth');

// Pemasukan Detail and Update Routes
Route::get('/pemasukan/detail/{id}', [TransaksiController::class, 'detailPemasukan'])->name('pemasukan.detail')->middleware('auth');
Route::get('/pemasukan/ubah/{id}', [TransaksiController::class, 'ubahPemasukan'])->name('pemasukan.ubah')->middleware('auth');
Route::post('/pemasukan/ubah/{id}', [TransaksiController::class, 'updatePemasukan'])->name('pemasukan.update')->middleware('auth');

// Pengeluaran Detail and Update Routes
Route::get('/pengeluaran/detail/{id}', [TransaksiController::class, 'detailPengeluaran'])->name('pengeluaran.detail')->middleware('auth');
Route::get('/pengeluaran/ubah/{id}', [TransaksiController::class, 'ubahPengeluaran'])->name('pengeluaran.ubah')->middleware('auth');
Route::post('/pengeluaran/ubah/{id}', [TransaksiController::class, 'updatePengeluaran'])->name('pengeluaran.update')->middleware('auth');

// Referensi and Laporan Routes
Route::get('/referensi/kategori', [ReferensiController::class, 'kategori'])->name('kategori')->middleware('auth');
Route::delete('/kategori/delete/{id}', [ReferensiController::class, 'kategoriDelete'])->name('kategori.delete')->middleware('auth');
Route::post('/kategori/store', [ReferensiController::class, 'store'])->name('kategori.store')->middleware('auth');
Route::put('/kategori/update/{id}', [ReferensiController::class, 'update'])->name('kategori.update')->middleware('auth');
Route::match(['get', 'post'], '/laporan/pemasukan', [LaporanController::class, 'pemasukan'])->name('laporan.pemasukan')->middleware('auth');
Route::match(['get', 'post'], '/laporan/pengeluaran', [LaporanController::class, 'pengeluaran'])->name('laporan.pengeluaran')->middleware('auth');
Route::match(['get', 'post'], '/laporan/kas', [LaporanController::class, 'kas'])->name('Laporan.Kas')->middleware('auth');
Route::get('/referensi/entridata/{id?}', [ReferensiController::class, 'entridata'])->name('Referensi.entridata')->middleware('auth');
Route::get('/dokumentasi/api', [ApiDocumentationController::class, 'index'])->name('dokumentasi.api')->middleware('auth');
