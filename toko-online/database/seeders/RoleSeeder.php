<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleDemoSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('production')) {
            return;
        }

        $akun = [
            ['USRADMIN00001', 'Admin', 'admin123@toko.online', 'admin_toko', 'admin'],
            ['USRSTAFF00001', 'Staff', 'staff123@toko.online', 'staff_toko', 'staff'],
            ['USRCUST000001', 'Customer Satu', 'customer1@toko.online', 'customer_satu', 'customer'],
            ['USRCUST000002', 'Customer Dua', 'customer2@toko.online', 'customer_dua', 'customer'],
        ];

        foreach ($akun as [$id, $nama, $email, $username, $role]) {
            $user = User::firstOrNew(['username' => $username]);

            $user->fill([
                'id_user' => $id,
                'nama_lengkap' => $nama,
                'email' => $email,
                'password' => 'password123',
                'alamat' => 'Alamat dummy',
            ]);

            $user->role = $role;
            $user->save();
        }
    }
}
