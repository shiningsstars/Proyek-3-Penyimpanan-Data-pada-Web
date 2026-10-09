<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('nama_barang')->paginate(12);

        return view('products', compact('products'));
    }

    public function show(Product $product)
    {
        return view('detail', compact('product'));
    }
}
