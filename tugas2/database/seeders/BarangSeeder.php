<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        Barang::insert([
            [
                'nama' => 'Buku Tulis',
                'harga' => 5000,
                'stok' => 50,
            ],
            [
                'nama' => 'Pulpen',
                'harga' => 3000,
                'stok' => 50,
            ],
            [
                'nama' => 'Penggaris',
                'harga' => 4000,
                'stok' => 30,
            ],
            [
                'nama' => 'Pensil 2B',
                'harga' => 2500,
                'stok' => 40,
            ],
            [
                'nama' => 'Penghapus',
                'harga' => 1500,
                'stok' => 25,
            ],
        ]);
    }
}