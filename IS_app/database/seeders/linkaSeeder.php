<?php

namespace Database\Seeders;

use App\Models\Linka;
use Illuminate\Database\Seeder;

class linkaSeeder extends Seeder
{
    private $rows = [
        ['cislo_linky' => 1, 'vozidla_linky' => 'Električka'],
        ['cislo_linky'=> 2, 'vozidla_linky'=> 'Električka'],
        ['cislo_linky'=> 47, 'vozidla_linky'=> 'Autobus'],
        ['cislo_linky'=> 62, 'vozidla_linky'=> 'Autobus'],
        ['cislo_linky'=> 32, 'vozidla_linky'=> 'Trolejbus'],
    ];
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->rows as $row) {
            Linka::create($row);
        }
    }
}
