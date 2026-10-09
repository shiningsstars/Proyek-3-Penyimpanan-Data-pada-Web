@extends('layout')

@section('content')

<h2>Daftar Produk</h2>

@if($products->count() > 0)

    @foreach($products as $product)
        <div class="produk">

            @if($product->gambar)
                <img src="{{ asset('images/' . $product->gambar) }}"
                     alt="{{ $product->nama_barang }}">
                <br>
            @endif

            <b>{{ $product->nama_barang }}</b>

            <p>Harga: Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
            <p>Stok: {{ $product->stok }}</p>

            <a href="{{ route('products.show', $product->id_barang) }}">
                Lihat Detail
            </a>

        </div>
    @endforeach

    {{ $products->links() }}

@else
    <p>Belum ada produk.</p>
@endif

@endsection
