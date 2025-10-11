<?php

namespace Database\Seeders;

use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Database\Seeder;

class DetailPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periksas = Periksa::all();
        $obats = Obat::all();

        foreach ($periksas as $periksa) {
            // Each periksa gets 1-3 random obats
            $numObats = rand(1, 3);
            $selectedObats = $obats->random($numObats);

            foreach ($selectedObats as $obat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obat->id,
                ]);
            }
        }
    }
}
