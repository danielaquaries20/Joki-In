<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return redirect('/login');
});

// Routes untuk Autentikasi (Mockup UI)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Route untuk simulasi aksi submit form
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');
Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');

// Route untuk melihat Dashboard Mitra
Route::get('/mitra/index', [MitraController::class, 'index'])
    ->middleware('role:mitra')
    ->name('mitra.dashboard');

// Route untuk memproses tombol Mulai/Akhiri Sesi
Route::post('/mitra/session/toggle', [MitraController::class, 'toggleSession'])
    ->middleware('role:mitra')
    ->name('mitra.session.toggle');

// Route untuk melihat Dashboard Klien
Route::get('/client/dashboard', [App\Http\Controllers\ClientController::class, 'index'])
    ->middleware('role:client')
    ->name('client.dashboard');

// Route untuk halaman Checkout / Pembayaran
Route::get('/client/checkout/{id}', [App\Http\Controllers\ClientController::class, 'checkout'])->name('client.checkout');
Route::post('/client/checkout/process', [App\Http\Controllers\ClientController::class, 'processCheckout'])->name('client.checkout.process');

// Route order
Route::get('/order/{id}', [MitraController::class, 'orderDetail'])
    ->name('order.detail');

// Route tambah jasa
Route::get('/mitra/service/create', [MitraController::class, 'createService'])
    ->middleware('role:mitra')
    ->name('mitra.service.create');

// Route untuk memproses penyimpanan data jasa ke database
Route::post('/mitra/service/store', [MitraController::class, 'storeService'])
    ->middleware('role:mitra')
    ->name('mitra.service.store');

// Route order detail
Route::get('/mitra/order/{id}', [MitraController::class, 'orderDetail'])
    ->middleware('role:mitra')
    ->name('mitra.detail');

// Route selesai
Route::post('/client/order/complete', [App\Http\Controllers\ClientController::class, 'completeOrder'])->name('client.order.complete');

// Route selesai mitra
Route::post('/mitra/order/finish',
    [MitraController::class, 'finishOrder'])
    ->name('mitra.order.finish');

//Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
