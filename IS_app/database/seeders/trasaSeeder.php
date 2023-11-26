<?php

namespace Database\Seeders;

use App\Models\Trasa;
use Illuminate\Database\Seeder;

class trasaSeeder extends Seeder
{
    private $rows = [
        ['meno_trasy' => 'Ečerova', 'id_linka' => 1],
        ['meno_trasy' => 'Řečkovice', 'id_linka' => 1],
        ['meno_trasy' => 'Modřice', 'id_linka' => 2],
        ['meno_trasy' => 'Stará osada', 'id_linka' => 2],
        ['meno_trasy' => 'Staré Černovice', 'id_linka' => 3],
        ['meno_trasy' => 'Hlavní nádraží', 'id_linka' => 3],
        ['meno_trasy' => 'Červený kopec', 'id_linka' => 4],
        ['meno_trasy' => 'Mendlovo náměstí', 'id_linka' => 4],
        ['meno_trasy' => 'Srbská', 'id_linka' => 5],
        ['meno_trasy' => 'Česká', 'id_linka' => 5],
    ];
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->rows as $row) {
            Trasa::create($row);
        }
    }
}
