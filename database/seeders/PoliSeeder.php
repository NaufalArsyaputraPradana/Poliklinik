<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = [
            [
                'nama_poli' => 'Poli Umum',
                'keterangan' => 'Pelayanan kesehatan umum untuk berbagai keluhan',
            ],
            [
                'nama_poli' => 'Poli Gigi',
                'keterangan' => 'Pelayanan kesehatan gigi dan mulut',
            ],
            [
                'nama_poli' => 'Poli Anak',
                'keterangan' => 'Pelayanan kesehatan khusus untuk anak-anak',
            ],
            [
                'nama_poli' => 'Poli Mata',
                'keterangan' => 'Pelayanan kesehatan mata',
            ],
        ];

        foreach ($polis as $poli) {
            Poli::create($poli);
        }
    }
}
