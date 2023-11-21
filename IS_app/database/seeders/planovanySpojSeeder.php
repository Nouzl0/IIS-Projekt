<?php

namespace Database\Seeders;

use App\Models\PlanovanySpoj;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class planovanySpojSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            ['zaciatok_trasy' => '2023-11-20 15:00:00', 'id_trasa' => 1, 'id_vozidlo' => 1, 'id_uzivatel_dispecer' => 4, 'id_uzivatel_sofer' => 5, 'opakovanie' => 'denne', 'platny_do' => '2023-11-30 23:00:00'],
            ['zaciatok_trasy' => '2023-11-10 16:00:00', 'id_trasa' => 2, 'id_vozidlo' => 2, 'id_uzivatel_dispecer' => 4, 'id_uzivatel_sofer' => 5, 'opakovanie' => 'denne', 'platny_do' => '2023-12-01 23:00:00'],
        ];

        foreach ($rows as $row) {
            PlanovanySpoj::create($row);
        }
    }
}
