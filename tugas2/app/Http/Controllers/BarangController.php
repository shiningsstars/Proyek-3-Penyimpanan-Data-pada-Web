<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        $jumlahKeranjang = count(session('keranjang', []));

        return view('barang', compact('barangs', 'jumlahKeranjang'));
    }

    public function keranjang()
    {
        $keranjang = session('keranjang', []);

        return view('keranjang', compact('keranjang'));
    }   

    public function tambah($id)
    {
        $barang = Barang::findOrFail($id);

        $keranjang = session('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']++;
        } else {
            $keranjang[$id] = [
                'id' => $barang->id,
                'nama' => $barang->nama,
                'harga' => $barang->harga,
                'jumlah' => 1,
            ];
        }

        session(['keranjang' => $keranjang]);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan ke keranjang.');
    }

    
    public function kurang($id)
    {
        $keranjang = session('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']--;

            if ($keranjang[$id]['jumlah'] <= 0) {
                unset($keranjang[$id]);
            }
        }

        session(['keranjang' => $keranjang]);

        return redirect()->route('keranjang.index');
    }

    public function tambahJumlah($id)
    {
        $keranjang = session('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']++;
        }

        session(['keranjang' => $keranjang]);

        return redirect()->route('keranjang.index');
    }

    public function hapus($id)
    {
        $keranjang = session('keranjang', []);

        unset($keranjang[$id]);

        session(['keranjang' => $keranjang]);

        return redirect()->route('keranjang.index');
    }

    public function kosongkan()
    {
        session()->forget('keranjang');

        return redirect()->route('keranjang.index');
    }
}