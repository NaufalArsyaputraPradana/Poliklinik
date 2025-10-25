<?php

namespace Database\Seeders;

use App\Models\DaftarPoli;
use App\Models\Periksa;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daftarPolis = DaftarPoli::all();

        $catatanList = [
            'Pasien mengalami demam ringan, diberikan obat penurun panas',
            'Tekanan darah normal, dianjurkan istirahat cukup',
            'Infeksi ringan pada tenggorokan, diberikan antibiotik',
            'Kondisi umum baik, diberikan vitamin untuk meningkatkan daya tahan tubuh',
            'Alergi musiman, diberikan antihistamin',
            'Gangguan pencernaan ringan, dianjurkan diet sehat',
            'Mata iritasi ringan, diberikan obat tetes mata',
            'Sakit kepala tegang, diberikan analgesik',
            'Kontrol rutin, kondisi stabil',
            'Pemeriksaan lanjutan diperlukan minggu depan',
        ];

        // Only create periksa for some of the daftar polis (simulate some have been examined)
        $processedDaftarPolis = $daftarPolis->take(ceil($daftarPolis->count() * 0.7));

        foreach ($processedDaftarPolis as $index => $daftarPoli) {
            Periksa::create([
                'id_daftar_poli' => $daftarPoli->id,
                'tgl_periksa' => Carbon::now()->subDays(rand(0, 7))->addHours(rand(8, 16)),
                'catatan' => $catatanList[$index % count($catatanList)],
                'biaya_periksa' => rand(50000, 200000),
            ]);

            // No need to update daftar_poli since relationship is now one-to-one via periksa.id_daftar_poli
        }
    }
}
