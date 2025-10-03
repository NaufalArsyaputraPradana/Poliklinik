<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'nama' => 'Administrator',
            'alamat' => 'Jl. Admin No. 1',
            'id_poli' => null,
            'no_ktp' => '1234567890123456',
            'no_hp' => '081234567890',
            'no_rm' => null,
            'role' => 'admin',
            'email' => 'admin@poliklinik.com',
            'password' => Hash::make('admin123'),
        ]);

        // Get poli IDs for doctors
        $poliUmum = Poli::where('nama_poli', 'Poli Umum')->first();
        $poliGigi = Poli::where('nama_poli', 'Poli Gigi')->first();
        $poliAnak = Poli::where('nama_poli', 'Poli Anak')->first();
        $poliMata = Poli::where('nama_poli', 'Poli Mata')->first();

        // Doctor users
        User::create([
            'nama' => 'Dr. Budi Santoso',
            'alamat' => 'Jl. Dokter No. 1',
            'id_poli' => $poliUmum->id,
            'no_ktp' => '1234567890123457',
            'no_hp' => '081234567891',
            'no_rm' => null,
            'role' => 'dokter',
            'email' => 'dr.budi@poliklinik.com',
            'password' => Hash::make('dokter123'),
        ]);

        User::create([
            'nama' => 'Dr. Siti Rahayu',
            'alamat' => 'Jl. Dokter No. 2',
            'id_poli' => $poliGigi->id,
            'no_ktp' => '1234567890123458',
            'no_hp' => '081234567892',
            'no_rm' => null,
            'role' => 'dokter',
            'email' => 'dr.siti@poliklinik.com',
            'password' => Hash::make('dokter123'),
        ]);

        User::create([
            'nama' => 'Dr. Ahmad Wijaya',
            'alamat' => 'Jl. Dokter No. 3',
            'id_poli' => $poliAnak->id,
            'no_ktp' => '1234567890123459',
            'no_hp' => '081234567893',
            'no_rm' => null,
            'role' => 'dokter',
            'email' => 'dr.ahmad@poliklinik.com',
            'password' => Hash::make('dokter123'),
        ]);

        User::create([
            'nama' => 'Dr. Maya Sari',
            'alamat' => 'Jl. Dokter No. 4',
            'id_poli' => $poliMata->id,
            'no_ktp' => '1234567890123460',
            'no_hp' => '081234567894',
            'no_rm' => null,
            'role' => 'dokter',
            'email' => 'dr.maya@poliklinik.com',
            'password' => Hash::make('dokter123'),
        ]);

        // Patient users
        User::create([
            'nama' => 'John Doe',
            'alamat' => 'Jl. Pasien No. 1',
            'id_poli' => null,
            'no_ktp' => '1234567890123461',
            'no_hp' => '081234567895',
            'no_rm' => 'RM001',
            'role' => 'pasien',
            'email' => 'john@email.com',
            'password' => Hash::make('pasien123'),
        ]);

        User::create([
            'nama' => 'Jane Smith',
            'alamat' => 'Jl. Pasien No. 2',
            'id_poli' => null,
            'no_ktp' => '1234567890123462',
            'no_hp' => '081234567896',
            'no_rm' => 'RM002',
            'role' => 'pasien',
            'email' => 'jane@email.com',
            'password' => Hash::make('pasien123'),
        ]);

        User::create([
            'nama' => 'Bob Johnson',
            'alamat' => 'Jl. Pasien No. 3',
            'id_poli' => null,
            'no_ktp' => '1234567890123463',
            'no_hp' => '081234567897',
            'no_rm' => 'RM003',
            'role' => 'pasien',
            'email' => 'bob@email.com',
            'password' => Hash::make('pasien123'),
        ]);
    }
}
