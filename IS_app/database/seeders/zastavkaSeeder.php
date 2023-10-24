<?php

namespace Database\Seeders;

use App\Models\Zastavka;
use Illuminate\Database\Seeder;

class zastavkaSeeder extends Seeder
{
    private $rows = [
        /* zastavky linky 1 v DPMB */
        ['meno_zastavky' => 'Řečkovice', 'adresa_zastavky' => '621 00 Brno-Řečkovice a Mokrá Hora'],
        ['meno_zastavky' => 'Semilasso', 'adresa_zastavky' => '612 00 Brno-Královo Pole'],
        ['meno_zastavky' => 'Pionýrska', 'adresa_zastavky' => '602 00 Brno-Královo Pole'],
        ['meno_zastavky' => 'Moravské náměstí', 'adresa_zastavky' => ''],
        ['meno_zastavky' => 'Hlavní nádraží', 'adresa_zastavky' => ''],
        ['meno_zastavky' => 'Mendlovo náměstí', 'adresa_zastavky' => ''],
        ['meno_zastavky' => 'Pisárky', 'adresa_zastavky' => ''],
        ['meno_zastavky' => 'Vozovna Komín', 'adresa_zastavky' => ''],
        ['meno_zastavky' => 'Zoologická zahrada', 'adresa_zastavky' => ''],
        ['meno_zastavky' => 'Ečerova', 'adresa_zastavky' => ''],

        /* zastavky linky 2 v DPMB */
        ['meno_zastavky' => 'Stará Osada', 'adresa_zastavky' => ''],
        ['meno_zastavky' => 'Tkalcovská', 'adresa_zastavky' => ''],
        //['meno_zastavky' => 'Hlavní nádraží', 'adresa_zastavky' => ''], uz existuje v linke 1
        ['meno_zastavky' => 'Poříčí', 'adresa_zastavky' => ''],
        ['meno_zastavky' => 'Celní', 'adresa_zastavky' => ''],
        ['meno_zastavky' => 'Ústřední hřbitov', 'adresa_zastavky' => ''],
        ['meno_zastavky' => 'Modřice', 'adresa_zastavky' => ''],

        /* zastavky linky 47 v DPMB */
        //['meno_zastavky' => 'Hlavní nádraží', 'adresa_zastavky' => ''], uz existuje v linke 1
        ['meno_zastavky' => 'Tržní', 'adresa_zastavky' => ''],
        ['meno_zastavky' => 'Faměrovo náměstí', 'adresa_zastavky' => ''],
        ['meno_zastavky' => 'Staré Černovice', 'adresa_zastavky' => ''],

        /* zastavky linky 62 v DPMB */
        //['meno_zastavky' => 'Mendlovo náměstí', 'adresa_zastavky' => ''], uz existuje v linke 1
        ['meno_zastavky' => 'Červený kopec', 'adresa_zastavky' => ''],

        /* zastavky linky 32 v DPMB */
        ['meno_zastavky' => 'Česká', 'adresa_zastavky' => ''],
        ['meno_zastavky' => 'Botanická', 'adresa_zastavky' => ''],
        ['meno_zastavky' => 'Slovanské náměstí', 'adresa_zastavky' => ''],
        ['meno_zastavky' => 'Srbská', 'adresa_zastavky' => ''],
    ];
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->rows as $row) {
            Zastavka::create($row);
        }
    }
}
