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
            ['meno_uzivatela' => 'root', 'priezvisko_uzivatela' => '', 'tel_cislo_uzivatela' => '', 'email_uzivatela' =>'root@dpmb.cz', 'uzivatelske_meno' =>'root', 'heslo_uzivatela' => Hash::make('root'), 'rola_uzivatela' => 'administrátor'],
            ['meno_uzivatela' => 'Ján', 'priezvisko_uzivatela' => 'Novák', 'tel_cislo_uzivatela' => '', 'email_uzivatela' =>'jan.novak@gmail.com', 'uzivatelske_meno' =>'xnovak00', 'heslo_uzivatela' => Hash::make('novak'), 'rola_uzivatela' => 'správca'],
            ['meno_uzivatela' => 'Jozef', 'priezvisko_uzivatela' => 'Dobrý', 'tel_cislo_uzivatela' => '', 'email_uzivatela' =>'jozef.dobry@gmail.com', 'uzivatelske_meno' =>'xdobry00', 'heslo_uzivatela' => Hash::make('dobry'), 'rola_uzivatela' => 'technik'],
            ['meno_uzivatela' => 'Anna', 'priezvisko_uzivatela' => 'Neumannová', 'tel_cislo_uzivatela' => '', 'email_uzivatela' =>'anna.neumannova@gmail.com', 'uzivatelske_meno' =>'xneuma00', 'heslo_uzivatela' => Hash::make('neumannova'), 'rola_uzivatela' => 'dispečer'],
            ['meno_uzivatela' => 'František', 'priezvisko_uzivatela' => 'Novotný', 'tel_cislo_uzivatela' => '', 'email_uzivatela' =>'frantisek.novotny@gmail.com', 'uzivatelske_meno' =>'xnovot00', 'heslo_uzivatela' => Hash::make('novotny'), 'rola_uzivatela' => 'vodič'],
        ];

        foreach ($rows as $row) {
            Uzivatel::create($row);
        }
    }
}
