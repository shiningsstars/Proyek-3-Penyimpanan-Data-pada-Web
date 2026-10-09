<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

Route::get('/', function () {
    return redirect()->route('barang.index');
});

Route::get('/barang', [BarangController::class, 'index'])
    ->name('barang.index');

Route::get('/keranjang', [BarangController::class, 'keranjang'])
    ->name('keranjang.index');

Route::post('/keranjang/tambah/{id}', [BarangController::class, 'tambah'])
    ->name('keranjang.tambah');

Route::post('/keranjang/tambah-jumlah/{id}', [BarangController::class, 'tambahJumlah'])
    ->name('keranjang.tambahJumlah');

Route::post('/keranjang/kurang/{id}', [BarangController::class, 'kurang'])
    ->name('keranjang.kurang');

Route::post('/keranjang/hapus/{id}', [BarangController::class, 'hapus'])
    ->name('keranjang.hapus');

Route::post('/keranjang/kosongkan', [BarangController::class, 'kosongkan'])
    ->name('keranjang.kosongkan');