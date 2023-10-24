<?php

namespace Database\Seeders;

use App\Models\Trasa;
use Illuminate\Database\Seeder;

class trasaSeeder extends Seeder
{
    private $rows = [
        ['meno_trasy' => 'Ečerova', 'info_trasy' => '', 'id_linka' => 1],
        ['meno_trasy' => 'Řečkovice', 'info_trasy' => '', 'id_linka' => 1],
        ['meno_trasy' => 'Modřice', 'info_trasy' => '', 'id_linka' => 2],
        ['meno_trasy' => 'Stará osada', 'info_trasy' => '', 'id_linka' => 2],
        ['meno_trasy' => 'Staré Černovice', 'info_trasy' => '', 'id_linka' => 3],
        ['meno_trasy' => 'Hlavní nádraží', 'info_trasy' => '', 'id_linka' => 3],
        ['meno_trasy' => 'Červený kopec', 'info_trasy' => '', 'id_linka' => 4],
        ['meno_trasy' => 'Mendlovo náměstí', 'info_trasy' => '', 'id_linka' => 4],
        ['meno_trasy' => 'Srbská', 'info_trasy' => '', 'id_linka' => 5],
        ['meno_trasy' => 'Česká', 'info_trasy' => '', 'id_linka' => 5],
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
