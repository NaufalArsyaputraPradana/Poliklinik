<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nama' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'alamat' => 'Jl. Admin No. 1',
                'no_ktp' => '1234567890123456',
                'no_hp' => '081234567890'
            ],
            [
                'nama' => 'Dokter',
                'email' => 'dokter@gmail.com',
                'password' => Hash::make('dokter'),
                'role' => 'dokter',
                'alamat' => 'Jl. Dokter No. 2',
                'no_ktp' => '2345678901234567',
                'no_hp' => '081234567891'
            ],
            [
                'nama' => 'Pasien',
                'email' => 'pasien@gmail.com',
                'password' => Hash::make('pasien'),
                'role' => 'pasien',
                'alamat' => 'Jl. Pasien No. 3',
                'no_ktp' => '3456789012345678',
                'no_hp' => '081234567892',
                'no_rm' => 'RM' . date('Ym') . '001',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
