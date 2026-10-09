@extends('layout')

@section('title', 'Detail Barang')

@section('content')
    <div class="card">
        <h1>{{ $product->nama_barang }}</h1>

        @if ($product->gambar)
            <img src="{{ asset('storage/' . $product->gambar) }}"
                 alt="{{ $product->nama_barang }}"
                 width="200">
        @endif

        <p>{{ $product->deskripsi }}</p>
        <p>Harga: Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
        <p>Stok: {{ $product->stok }}</p>

        <a class="button" href="{{ route('products.index') }}">
            Kembali
        </a>
    </div>
@endsection