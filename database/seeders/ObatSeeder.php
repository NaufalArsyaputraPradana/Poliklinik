<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obats = [
            [
                'nama_obat' => 'Paracetamol',
                'kemasan' => 'Tablet 500mg',
                'harga' => 5000,
            ],
            [
                'nama_obat' => 'Amoxicillin',
                'kemasan' => 'Kapsul 500mg',
                'harga' => 8000,
            ],
            [
                'nama_obat' => 'Ibuprofen',
                'kemasan' => 'Tablet 400mg',
                'harga' => 7000,
            ],
            [
                'nama_obat' => 'Cetirizine',
                'kemasan' => 'Tablet 10mg',
                'harga' => 6000,
            ],
            [
                'nama_obat' => 'Omeprazole',
                'kemasan' => 'Kapsul 20mg',
                'harga' => 12000,
            ],
            [
                'nama_obat' => 'Dexamethasone',
                'kemasan' => 'Tablet 0.5mg',
                'harga' => 4000,
            ],
            [
                'nama_obat' => 'Antasida',
                'kemasan' => 'Tablet Kunyah',
                'harga' => 3000,
            ],
            [
                'nama_obat' => 'Vitamin C',
                'kemasan' => 'Tablet 500mg',
                'harga' => 2500,
            ],
            [
                'nama_obat' => 'Salbutamol',
                'kemasan' => 'Inhaler',
                'harga' => 45000,
            ],
            [
                'nama_obat' => 'Metformin',
                'kemasan' => 'Tablet 500mg',
                'harga' => 9000,
            ],
        ];

        foreach ($obats as $obat) {
            Obat::create($obat);
        }
    }
}
