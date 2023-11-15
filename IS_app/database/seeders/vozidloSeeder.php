<?php

namespace Database\Seeders;

use App\Models\Vozidlo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class vozidloSeeder extends Seeder
{
    private $rows = [
        ['nazov' => 'Škoda 13T','spz' =>'7C25025', 'druh_vozidla' => 'Električka', 'znacka_vozidla' => 'Škoda'],
        ['nazov' => 'Škoda 13T', 'spz' =>'7C25026', 'druh_vozidla' => 'Električka', 'znacka_vozidla' => 'Škoda'],
        ['nazov' => 'Iveco Urbanway 12M', 'spz' =>'7C25027', 'druh_vozidla' => 'Autobus', 'znacka_vozidla' => 'Iveco'],
        ['nazov' => 'Iveco Urbanway 12M', 'spz' =>'7C25028', 'druh_vozidla' => 'Autobus', 'znacka_vozidla' => 'Iveco'],
        ['nazov' => 'SOR TNS 12', 'spz' =>'7C25029', 'druh_vozidla' => 'Trolejbus', 'znacka_vozidla' => 'SOR'],
        ['nazov' => 'SOR TNS 12', 'spz' =>'7C25030', 'druh_vozidla' => 'Trolejbus', 'znacka_vozidla' => 'SOR'],
    ];
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->rows as $row) {
            Vozidlo::create($row);
        }
    }
}
