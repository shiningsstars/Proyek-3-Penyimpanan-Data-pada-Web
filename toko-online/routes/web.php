<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

Route::get('/', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/barang/{product:id_barang}', [ProductController::class, 'show'])
    ->name('products.show');

Route::middleware('guest')->group(function () {
    Route::get('/daftar', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/daftar', [AuthController::class, 'register'])
        ->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/keranjang', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/keranjang/tambah/{id_barang}', [CartController::class, 'store'])
        ->name('cart.store');

    Route::put('/keranjang/update/{id_barang}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/keranjang/hapus/{id_barang}', [CartController::class, 'destroy'])
        ->name('cart.destroy');

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    Route::get('/riwayat-pesanan', [OrderController::class, 'index'])
    ->name('orders.index');

    Route::get('/riwayat-pesanan/{id_order}', [OrderController::class, 'show'])
        ->name('orders.show');

    Route::get('/riwayat-pesanan', [OrderController::class, 'index'])
    ->name('orders.index');

    Route::get('/riwayat-pesanan/{id_order}', [OrderController::class, 'show'])
        ->name('orders.show');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');