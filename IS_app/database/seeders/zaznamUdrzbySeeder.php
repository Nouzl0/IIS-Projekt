<?php

namespace Database\Seeders;

use App\Models\Udrzba;
use App\Models\ZaznamUdrzby;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class zaznamUdrzbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            ['id_udrzba' => 1, 'id_uzivatel_technik' => 3],
        ];

        foreach ($rows as $row) {
            ZaznamUdrzby::create($row);
            Udrzba::where('id_udrzba', '=', $rows[0]['id_udrzba'])->update(['stav' => 'Priradená']);
        }
    }
}
