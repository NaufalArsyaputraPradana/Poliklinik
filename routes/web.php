<?php

use App\Http\Controllers\{
    AuthController,
    AdminController,
    DokterController,
    PasienController,
    PoliController,
    ObatController,
    JadwalPeriksaController,
    PeriksaController,
    DaftarPoliController
};
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
 * Admin Dashboard Routes
 */
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Resource Management
    Route::resource('polis', PoliController::class)->except(['show']);
    Route::resource('dokter', DokterController::class)->except(['show']);
    Route::resource('pasien', PasienController::class)->except(['show']);
    Route::resource('obat', ObatController::class)->except(['show']);
});

/**
 * Dokter Dashboard Routes
 */
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    // Dashboard
    Route::get('/', [DokterController::class, 'index'])->name('index');
    Route::get('/dashboard', [DokterController::class, 'dashboard'])->name('dashboard');

    // Jadwal Management
    Route::resource('jadwal-periksa', JadwalPeriksaController::class)->except(['show']);

    // Patient Examination
    Route::prefix('periksa-pasien')->name('periksa-pasien.')->group(function () {
        Route::get('/', [PeriksaController::class, 'index'])->name('index');
        Route::get('/{id}', [PeriksaController::class, 'show'])->name('show');
        Route::post('/{id}', [PeriksaController::class, 'store'])->name('store');
    });

    // Patient History
    Route::get('/riwayat-pasien', [PeriksaController::class, 'riwayat'])->name('riwayat-pasien.index');
});

/**
 * Pasien Dashboard Routes
 */
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    // Dashboard
    Route::get('/', [PasienController::class, 'index'])->name('index');
    Route::get('/dashboard', [PasienController::class, 'dashboard'])->name('dashboard');

    // Poli Registration
    Route::prefix('daftar')->name('daftar.')->group(function () {
        Route::get('/', [DaftarPoliController::class, 'create'])->name('create');
        Route::post('/', [DaftarPoliController::class, 'store'])->name('store');
    });

    // Medical History
    Route::get('/riwayat', [DaftarPoliController::class, 'index'])->name('riwayat');
});
