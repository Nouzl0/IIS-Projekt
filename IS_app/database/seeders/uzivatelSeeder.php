<?php

namespace Database\Seeders;

use App\Models\Uzivatel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class uzivatelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //$root_password = Hash::make('root');

        $rows = [
            ['meno_uzivatela' => '', 'priezvisko_uzivatela' => '', 'tel_cislo_uzivatela' => '', 'email_uzivatela' =>'', 'uzivatelske_meno' =>'root', 'heslo_uzivatela' => Hash::make('root'), 'rola_uzivatela' => 'administrátor'],
        ];

        foreach ($rows as $row) {
            Uzivatel::create($row);
        }
    }
}
