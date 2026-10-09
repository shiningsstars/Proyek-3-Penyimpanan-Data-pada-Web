@extends('layout')

@section('content')

<h2>Detail Produk</h2>

@if($product->gambar)
    <img
        src="{{ asset('images/' . $product->gambar) }}"
        alt="{{ $product->nama_barang }}"
        width="200"
    >
    <br>
@endif

<h3>{{ $product->nama_barang }}</h3>

<p>{{ $product->deskripsi }}</p>

<p>
    Harga: Rp{{ number_format($product->harga, 0, ',', '.') }}
</p>

<p>Stok: {{ $product->stok }}</p>

@if($product->stok > 0)

    @auth
        <form
            action="{{ route('cart.store', $product->id_barang) }}"
            method="POST"
        >
            @csrf

            <label for="jumlah">Jumlah:</label>

            <input
                type="number"
                id="jumlah"
                name="jumlah"
                value="1"
                min="1"
                max="{{ $product->stok }}"
                required
            >

            <button type="submit">Tambah ke Keranjang</button>
        </form>

        @if($errors->any())
            <p style="color:red;">
                {{ $errors->first() }}
            </p>
        @endif
    @else
        <p>Login terlebih dahulu untuk membeli produk.</p>
        <a href="{{ route('login') }}">Login</a>
    @endauth

@else
    <p>Stok habis, produk tidak dapat dibeli.</p>
@endif

<br>

<a href="{{ route('products.index') }}">Kembali ke Daftar Produk</a>

@endsection