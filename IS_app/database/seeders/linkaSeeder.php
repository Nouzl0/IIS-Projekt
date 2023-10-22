<?php

namespace Database\Seeders;

use App\Models\Linka;
use Illuminate\Database\Seeder;

class linkaSeeder extends Seeder
{

    private $linky_data = [
        ['cislo_linky' => 1, 'meno_linky' => 'Řečkovice_Ečerova'],
        ['cislo_linky'=> 12, 'meno_linky'=> 'Komárov_Technologický_park'],
    ];
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->linky_data as $data) {
            Linka::create($data);
        }
    }
}
