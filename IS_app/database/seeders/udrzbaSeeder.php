<?php

namespace Database\Seeders;

use App\Models\Udrzba;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class udrzbaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            ['id_vozidlo' => 1, 'zaciatok_udrzby' => '2023-11-25 16:00:00', 'nazov_spravy' => 'Rozbité čelné sklo', 'spz' => '7C25025', 'stav' => 'Vytvorená', 'popis' => 'Rozbité čelné sklo.'],
        ];

        foreach ($rows as $row) {
            Udrzba::create($row);
        }
    }
}
