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
            ['zaciatok_trasy' => Carbon::tomorrow()->setTime(15, 0), 'id_trasa' => 1, 'id_vozidlo' => 1, 'id_uzivatel_dispecer' => 4, 'id_uzivatel_sofer' => 5],
        ];

        foreach ($rows as $row) {
            PlanovanySpoj::create($row);
        }
    }
}
