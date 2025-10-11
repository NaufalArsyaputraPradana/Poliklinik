<?php

namespace Database\Seeders;

use App\Models\JadwalPeriksa;
use App\Models\User;
use Illuminate\Database\Seeder;

class JadwalPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokters = User::where('role', 'dokter')->get();

        $jadwalData = [
            [
                'hari' => 'Senin',
                'jam_mulai' => '08:00',
                'jam_selesai' => '12:00',
            ],
            [
                'hari' => 'Selasa',
                'jam_mulai' => '08:00',
                'jam_selesai' => '12:00',
            ],
            [
                'hari' => 'Rabu',
                'jam_mulai' => '13:00',
                'jam_selesai' => '17:00',
            ],
            [
                'hari' => 'Kamis',
                'jam_mulai' => '08:00',
                'jam_selesai' => '12:00',
            ],
            [
                'hari' => 'Jumat',
                'jam_mulai' => '08:00',
                'jam_selesai' => '11:00',
            ],
        ];

        foreach ($dokters as $index => $dokter) {
            $jadwal = $jadwalData[$index % count($jadwalData)];

            JadwalPeriksa::create([
                'id_dokter' => $dokter->id,
                'hari' => $jadwal['hari'],
                'jam_mulai' => $jadwal['jam_mulai'],
                'jam_selesai' => $jadwal['jam_selesai'],
                'aktif' => 'Y',
            ]);

            // Add a second schedule for some doctors
            if ($index < 2) {
                $nextIndex = ($index + 1) % count($jadwalData);
                $nextJadwal = $jadwalData[$nextIndex];

                JadwalPeriksa::create([
                    'id_dokter' => $dokter->id,
                    'hari' => $nextJadwal['hari'],
                    'jam_mulai' => $nextJadwal['jam_mulai'],
                    'jam_selesai' => $nextJadwal['jam_selesai'],
                    'aktif' => 'T',
                ]);
            }
        }
    }
}
