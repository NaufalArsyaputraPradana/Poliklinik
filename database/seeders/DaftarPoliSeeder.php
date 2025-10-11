<?php

namespace Database\Seeders;

use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\User;
use Illuminate\Database\Seeder;

class DaftarPoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pasiens = User::where('role', 'pasien')->get();
        $jadwalPeriksas = JadwalPeriksa::all();

        $keluhanList = [
            'Demam dan batuk sudah 3 hari',
            'Sakit kepala yang tidak kunjung sembuh',
            'Nyeri perut setelah makan',
            'Flu dan pilek berkepanjangan',
            'Ruam kulit yang gatal',
            'Mata merah dan berair',
            'Sakit gigi yang mengganggu',
            'Sesak nafas ringan',
            'Nyeri punggung bawah',
            'Gangguan pencernaan',
        ];

        $antrianCounter = [];

        foreach ($pasiens as $index => $pasien) {
            for ($i = 0; $i < 2; $i++) {
                $jadwal = $jadwalPeriksas->random();

                // Initialize antrian counter for this jadwal if not exists
                if (! isset($antrianCounter[$jadwal->id])) {
                    $antrianCounter[$jadwal->id] = 1;
                }

                DaftarPoli::create([
                    'id_pasien' => $pasien->id,
                    'id_jadwal' => $jadwal->id,
                    'keluhan' => $keluhanList[($index * 2 + $i) % count($keluhanList)],
                    'no_antrian' => $antrianCounter[$jadwal->id],
                ]);

                $antrianCounter[$jadwal->id]++;
            }
        }
    }
}
