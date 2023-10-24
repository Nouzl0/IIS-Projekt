<?php

namespace Database\Seeders;

use App\Models\Usek;
use Illuminate\Database\Seeder;

class usekSeeder extends Seeder
{
    private $rows = [
        // LINKA 1 v DPMB
        // úseky linky 1 v DPMB, trasa Řečkovice->Ečerova
        ['poradie_useku' => 1, 'id_trasa' => 1, 'id_zastavka_zaciatok' => 1, 'id_zastavka_koniec' => 2, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 6],
        ['poradie_useku' => 2, 'id_trasa' => 1, 'id_zastavka_zaciatok' => 2, 'id_zastavka_koniec' => 3, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 8],
        ['poradie_useku' => 3, 'id_trasa' => 1, 'id_zastavka_zaciatok' => 3, 'id_zastavka_koniec' => 4, 'dlzka_useku_km' => 1, 'cas_useku_minuty' => 3],
        ['poradie_useku' => 4, 'id_trasa' => 1, 'id_zastavka_zaciatok' => 4, 'id_zastavka_koniec' => 5, 'dlzka_useku_km' => 1, 'cas_useku_minuty' => 6],
        ['poradie_useku' => 5, 'id_trasa' => 1, 'id_zastavka_zaciatok' => 5, 'id_zastavka_koniec' => 6, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 7],
        ['poradie_useku' => 6, 'id_trasa' => 1, 'id_zastavka_zaciatok' => 6, 'id_zastavka_koniec' => 7, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 6],
        ['poradie_useku' => 7, 'id_trasa' => 1, 'id_zastavka_zaciatok' => 7, 'id_zastavka_koniec' => 8, 'dlzka_useku_km' => 3, 'cas_useku_minuty' => 5],
        ['poradie_useku' => 8, 'id_trasa' => 1, 'id_zastavka_zaciatok' => 8, 'id_zastavka_koniec' => 9, 'dlzka_useku_km' => 3, 'cas_useku_minuty' => 6],
        ['poradie_useku' => 9, 'id_trasa' => 1, 'id_zastavka_zaciatok' => 9, 'id_zastavka_koniec' => 10, 'dlzka_useku_km' => 3, 'cas_useku_minuty' => 6],

        // úseky linky 1 v DPMB, trasa Ečerova->Řečkovice
        ['poradie_useku' => 1, 'id_trasa' => 2, 'id_zastavka_zaciatok' => 10, 'id_zastavka_koniec' => 9, 'dlzka_useku_km' => 3, 'cas_useku_minuty' => 6],
        ['poradie_useku' => 2, 'id_trasa' => 2, 'id_zastavka_zaciatok' => 9, 'id_zastavka_koniec' => 8, 'dlzka_useku_km' => 3, 'cas_useku_minuty' => 6],
        ['poradie_useku' => 3, 'id_trasa' => 2, 'id_zastavka_zaciatok' => 8, 'id_zastavka_koniec' => 7, 'dlzka_useku_km' => 3, 'cas_useku_minuty' => 5],
        ['poradie_useku' => 4, 'id_trasa' => 2, 'id_zastavka_zaciatok' => 7, 'id_zastavka_koniec' => 6, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 6],
        ['poradie_useku' => 5, 'id_trasa' => 2, 'id_zastavka_zaciatok' => 6, 'id_zastavka_koniec' => 5, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 7],
        ['poradie_useku' => 6, 'id_trasa' => 2, 'id_zastavka_zaciatok' => 5, 'id_zastavka_koniec' => 4, 'dlzka_useku_km' => 1, 'cas_useku_minuty' => 6],
        ['poradie_useku' => 7, 'id_trasa' => 2, 'id_zastavka_zaciatok' => 4, 'id_zastavka_koniec' => 3, 'dlzka_useku_km' => 1, 'cas_useku_minuty' => 3],
        ['poradie_useku' => 8, 'id_trasa' => 2, 'id_zastavka_zaciatok' => 3, 'id_zastavka_koniec' => 2, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 8],
        ['poradie_useku' => 9, 'id_trasa' => 2, 'id_zastavka_zaciatok' => 2, 'id_zastavka_koniec' => 1, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 6],

        // LINKA 2 v DPMB
        // úseky linky 2 v DPMB, trasa Stará osada->Modřice
        ['poradie_useku' => 1, 'id_trasa' => 3, 'id_zastavka_zaciatok' => 11, 'id_zastavka_koniec' => 12, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 4],
        ['poradie_useku' => 2, 'id_trasa' => 3, 'id_zastavka_zaciatok' => 12, 'id_zastavka_koniec' => 5, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 8],
        ['poradie_useku' => 3, 'id_trasa' => 3, 'id_zastavka_zaciatok' => 5, 'id_zastavka_koniec' => 13, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 6],
        ['poradie_useku' => 4, 'id_trasa' => 3, 'id_zastavka_zaciatok' => 13, 'id_zastavka_koniec' => 14, 'dlzka_useku_km' => 1, 'cas_useku_minuty' => 3],
        ['poradie_useku' => 5, 'id_trasa' => 3, 'id_zastavka_zaciatok' => 14, 'id_zastavka_koniec' => 15, 'dlzka_useku_km' => 1, 'cas_useku_minuty' => 3],
        ['poradie_useku' => 6, 'id_trasa' => 3, 'id_zastavka_zaciatok' => 15, 'id_zastavka_koniec' => 16, 'dlzka_useku_km' => 5, 'cas_useku_minuty' => 10],

        // úseky linky 2 v DPMB, trasa Modřice->Stará osada
        ['poradie_useku' => 1, 'id_trasa' => 4, 'id_zastavka_zaciatok' => 16, 'id_zastavka_koniec' => 15, 'dlzka_useku_km' => 5, 'cas_useku_minuty' => 10],
        ['poradie_useku' => 2, 'id_trasa' => 4, 'id_zastavka_zaciatok' => 15, 'id_zastavka_koniec' => 14, 'dlzka_useku_km' => 1, 'cas_useku_minuty' => 3],
        ['poradie_useku' => 3, 'id_trasa' => 4, 'id_zastavka_zaciatok' => 14, 'id_zastavka_koniec' => 13, 'dlzka_useku_km' => 1, 'cas_useku_minuty' => 3],
        ['poradie_useku' => 4, 'id_trasa' => 4, 'id_zastavka_zaciatok' => 13, 'id_zastavka_koniec' => 5, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 6],
        ['poradie_useku' => 5, 'id_trasa' => 4, 'id_zastavka_zaciatok' => 5, 'id_zastavka_koniec' => 12, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 8],
        ['poradie_useku' => 6, 'id_trasa' => 4, 'id_zastavka_zaciatok' => 12, 'id_zastavka_koniec' => 11, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 4],

        // LINKA 47 v DPMB
        // úseky linky 47 v DPMB, trasa Hlavní nádraží->Staré Černovice
        ['poradie_useku' => 1, 'id_trasa' => 5, 'id_zastavka_zaciatok' => 5, 'id_zastavka_koniec' => 17, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 6],
        ['poradie_useku' => 2, 'id_trasa' => 5, 'id_zastavka_zaciatok' => 17, 'id_zastavka_koniec' => 18, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 4],
        ['poradie_useku' => 3, 'id_trasa' => 5, 'id_zastavka_zaciatok' => 18, 'id_zastavka_koniec' => 19, 'dlzka_useku_km' => 1, 'cas_useku_minuty' => 3],

        // úseky linky 47 v DPMB, trasa Staré Černovice->Hlavní nádraží
        ['poradie_useku' => 1, 'id_trasa' => 6, 'id_zastavka_zaciatok' => 19, 'id_zastavka_koniec' => 18, 'dlzka_useku_km' => 1, 'cas_useku_minuty' => 3],
        ['poradie_useku' => 2, 'id_trasa' => 6, 'id_zastavka_zaciatok' => 18, 'id_zastavka_koniec' => 17, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 4],
        ['poradie_useku' => 3, 'id_trasa' => 6, 'id_zastavka_zaciatok' => 17, 'id_zastavka_koniec' => 5, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 6],

        // LINKA 62 v DPMB
        // úseky linky 62 v DPMB, trasa Mendlovo náměstí->Červený kopec
        ['poradie_useku' => 1, 'id_trasa' => 7, 'id_zastavka_zaciatok' => 6, 'id_zastavka_koniec' => 20, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 5],

        // úseky linky 62 v DPMB, trasa Červený kopec->Mendlovo náměstí
        ['poradie_useku' => 1, 'id_trasa' => 8, 'id_zastavka_zaciatok' => 20, 'id_zastavka_koniec' => 6, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 5],

        // LINKA 32 v DPMB
        // úseky linky 32 v DPMB, trasa Česká->Srbská
        ['poradie_useku' => 1, 'id_trasa' => 9, 'id_zastavka_zaciatok' => 21, 'id_zastavka_koniec' => 22, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 6],
        ['poradie_useku' => 2, 'id_trasa' => 9, 'id_zastavka_zaciatok' => 22, 'id_zastavka_koniec' => 23, 'dlzka_useku_km' => 1, 'cas_useku_minuty' => 4],
        ['poradie_useku' => 3, 'id_trasa' => 9, 'id_zastavka_zaciatok' => 23, 'id_zastavka_koniec' => 24, 'dlzka_useku_km' => 1, 'cas_useku_minuty' => 4],

        // úseky linky 32 v DPMB, trasa Srbská->Česká
        ['poradie_useku' => 1, 'id_trasa' => 10, 'id_zastavka_zaciatok' => 24, 'id_zastavka_koniec' => 23, 'dlzka_useku_km' => 1, 'cas_useku_minuty' => 4],
        ['poradie_useku' => 2, 'id_trasa' => 10, 'id_zastavka_zaciatok' => 23, 'id_zastavka_koniec' => 22, 'dlzka_useku_km' => 1, 'cas_useku_minuty' => 4],
        ['poradie_useku' => 3, 'id_trasa' => 10, 'id_zastavka_zaciatok' => 22, 'id_zastavka_koniec' => 21, 'dlzka_useku_km' => 2, 'cas_useku_minuty' => 6],
    ];
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->rows as $row) {
            Usek::create($row);
        }
    }
}
