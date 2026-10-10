<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
            ->where('id_user', Auth::user()->id_user)
            ->orderBy('tanggal_order', 'desc')
            ->get();

        return view('orders', compact('orders'));
    }

    public function show($id_order)
    {
        $order = DB::table('orders')
            ->where('id_order', $id_order)
            ->where('id_user', Auth::user()->id_user)
            ->first();

        if (!$order) {
            abort(404);
        }

        $details = DB::table('order_details')
            ->join(
                'products',
                'order_details.id_barang',
                '=',
                'products.id_barang'
            )
            ->where('order_details.id_order', $id_order)
            ->select(
                'order_details.id_barang',
                'products.nama_barang',
                'products.gambar',
                'order_details.harga_satuan',
                'order_details.jumlah_beli'
            )
            ->get();

        return view('order-detail', compact('order', 'details'));
    }
}