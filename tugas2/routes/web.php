<?php

use Illuminate\Support\Facades\Route;
use App\Models\Barang;

Route::get('/', function () {
    $barangs = Barang::all();

    $jumlahKeranjang = count(session('keranjang', []));

    return view('barang.index', compact('barangs', 'jumlahKeranjang'));
});