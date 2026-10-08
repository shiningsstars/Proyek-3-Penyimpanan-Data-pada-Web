<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'hasya',
            'password' => 'hasyanada123',
            'nama_lengkap' => 'Hasya Nadana Hakim',
        ]);

        User::create([
            'username' => 'jeonghan',
            'password' => 'yjeonghan1004',
            'nama_lengkap' => 'Yoon Jeonghan',
        ]);
    }
}