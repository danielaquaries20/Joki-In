<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\AuthController;

// Routes untuk Autentikasi (Mockup UI)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Route untuk simulasi aksi submit form
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');
Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');

// Route untuk melihat Dashboard Mitra
Route::get('/mitra/dashboard', [MitraController::class, 'index'])->name('mitra.dashboard');

// Route untuk memproses tombol Mulai/Akhiri Sesi
Route::post('/mitra/session/toggle', [MitraController::class, 'toggleSession'])->name('mitra.session.toggle');

// Route untuk melihat Dashboard Klien
Route::get('/client/dashboard', [App\Http\Controllers\ClientController::class, 'index'])->name('client.dashboard');

// Route untuk halaman Checkout / Pembayaran
Route::get('/client/checkout/{id}', [App\Http\Controllers\ClientController::class, 'checkout'])->name('client.checkout');
Route::post('/client/checkout/process', [App\Http\Controllers\ClientController::class, 'processCheckout'])->name('client.checkout.process');


