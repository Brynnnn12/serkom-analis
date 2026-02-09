<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login')->middleware('guest.multiple:web,pelanggan');
Route::get('/pelanggan/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('pelanggan.login.form')->middleware('guest.multiple:web,pelanggan');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware('auth:web')->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::resource('tarifs', App\Http\Controllers\TarifController::class);
    Route::resource('pelanggans', App\Http\Controllers\PelangganController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('penggunaans/get-meter-awal', [App\Http\Controllers\PenggunaanController::class, 'getPreviousMeter'])->name('penggunaans.getPreviousMeter');
    Route::resource('penggunaans', App\Http\Controllers\PenggunaanController::class);
    Route::resource('tagihans', App\Http\Controllers\TagihanController::class);
    Route::resource('pembayarans', App\Http\Controllers\PembayaranController::class);
});

// Pelanggan routes
Route::middleware('auth:pelanggan')->prefix('pelanggan')->group(function () {
    Route::get('/dashboard', function () {
        return view('pelanggan.dashboard');
    })->name('pelanggan.dashboard');

    Route::get('/profil', function () {
        return view('pelanggan.profil');
    })->name('pelanggan.profil');

    Route::resource('tagihans', App\Http\Controllers\TagihanController::class)->only(['index', 'show'])->names([
        'index' => 'pelanggan.tagihans.index',
        'show' => 'pelanggan.tagihans.show'
    ]);
    Route::resource('pembayarans', App\Http\Controllers\PembayaranController::class)->only(['index', 'show'])->names([
        'index' => 'pelanggan.pembayarans.index',
        'show' => 'pelanggan.pembayarans.show'
    ]);
});
