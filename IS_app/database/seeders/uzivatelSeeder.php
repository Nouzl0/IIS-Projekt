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
            ['meno_uzivatela' => 'Root', 'priezvisko_uzivatela' => 'Account', 'email_uzivatela' =>'root@dpmb.cz', 'heslo_uzivatela' => Hash::make('root'), 'rola_uzivatela' => 'administrátor'],
            ['meno_uzivatela' => 'Ján', 'priezvisko_uzivatela' => 'Novák', 'email_uzivatela' =>'jan.novak@gmail.com', 'heslo_uzivatela' => Hash::make('novak'), 'rola_uzivatela' => 'správca'],
            ['meno_uzivatela' => 'Jozef', 'priezvisko_uzivatela' => 'Dobrý', 'email_uzivatela' =>'jozef.dobry@gmail.com', 'heslo_uzivatela' => Hash::make('dobry'), 'rola_uzivatela' => 'technik'],
            ['meno_uzivatela' => 'Anna', 'priezvisko_uzivatela' => 'Neumannová', 'email_uzivatela' =>'anna.neumannova@gmail.com', 'heslo_uzivatela' => Hash::make('neumannova'), 'rola_uzivatela' => 'dispečer'],
            ['meno_uzivatela' => 'František', 'priezvisko_uzivatela' => 'Novotný', 'email_uzivatela' =>'frantisek.novotny@gmail.com', 'heslo_uzivatela' => Hash::make('novotny'), 'rola_uzivatela' => 'vodič'],
        ];

        foreach ($rows as $row) {
            Uzivatel::create($row);
        }
    }
}
