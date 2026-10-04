<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BasisPengetahuanController;
use App\Http\Controllers\BobotKeyakinanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\KategoriHewanController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\RiwayatDiagnosaController;
use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
// Halaman Utama
=======
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354
Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
// Guest / Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
=======
// Guest Authentication Routes
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Register Routes
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354

// Authenticated Routes
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Admin & Expert System Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/kategori-hewan', [KategoriHewanController::class, 'index'])->name('kategori');
    Route::post('/kategori-hewan', [KategoriHewanController::class, 'store'])->name('kategori.store');
    Route::put('/kategori-hewan/{kategori}', [KategoriHewanController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori-hewan/{kategori}', [KategoriHewanController::class, 'destroy'])->name('kategori.destroy');
    Route::get('/penyakit', [PenyakitController::class, 'index'])->name('penyakit');
    Route::get('/gejala', [GejalaController::class, 'index'])->name('gejala');
    Route::get('/basis-pengetahuan', [BasisPengetahuanController::class, 'index'])->name('basis-pengetahuan');
    Route::get('/bobot-keyakinan', [BobotKeyakinanController::class, 'index'])->name('bobot-keyakinan');
    Route::get('/riwayat-diagnosa', [RiwayatDiagnosaController::class, 'index'])->name('riwayat');
<<<<<<< HEAD
});
=======
});
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354
