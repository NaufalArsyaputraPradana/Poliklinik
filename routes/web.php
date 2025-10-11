<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\JadwalPeriksaController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\DaftarPoliController;
use Illuminate\Support\Facades\Route;

/**
 * Public Routes
 */
Route::get('/', function () {
    return view('home');
})->name('home');

/**
 * Authentication Routes
 */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/**
 * Dashboard Routes
 */
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Admin management routes
    Route::resource('polis', PoliController::class);
    Route::resource('dokter', DokterController::class, ['except' => ['show']]);
    Route::resource('pasien', PasienController::class, ['except' => ['show']]);
    Route::resource('obat', ObatController::class);
});

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/', [DokterController::class, 'index'])->name('index');
    Route::get('/dashboard', [DokterController::class, 'dashboard'])->name('dashboard');

    // Dokter specific routes
    Route::resource('jadwal-periksa', JadwalPeriksaController::class)->names([
        'index' => 'jadwal-periksa.index',
        'create' => 'jadwal-periksa.create',
        'store' => 'jadwal-periksa.store',
        'show' => 'jadwal-periksa.show',
        'edit' => 'jadwal-periksa.edit',
        'update' => 'jadwal-periksa.update',
        'destroy' => 'jadwal-periksa.destroy',
    ]);

    Route::get('/periksa-pasien', [PeriksaController::class, 'index'])->name('periksa-pasien.index');
    Route::get('/periksa-pasien/{id}', [PeriksaController::class, 'show'])->name('periksa-pasien.show');
    Route::post('/periksa-pasien/{id}', [PeriksaController::class, 'store'])->name('periksa-pasien.store');

    Route::get('/riwayat-pasien', [PeriksaController::class, 'riwayat'])->name('riwayat-pasien.index');
});

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/', [PasienController::class, 'index'])->name('index');
    Route::get('/dashboard', [PasienController::class, 'dashboard'])->name('dashboard');

    // Pasien specific routes
    Route::get('/daftar', [DaftarPoliController::class, 'create'])->name('daftar');
    Route::post('/daftar', [DaftarPoliController::class, 'store'])->name('daftar.store');
    Route::get('/riwayat', [DaftarPoliController::class, 'index'])->name('riwayat');
});
