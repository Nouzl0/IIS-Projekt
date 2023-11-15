<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uzivatel extends Model
{
    // Set table name
    protected $table = 'uzivatel';

    // Define primary key
    protected $primaryKey = 'id_uzivatel';

    // Define fillable columns
    protected $fillable = [
        'meno_uzivatela',
        'priezvisko_uzivatela',
        'tel_cislo_uzivatela',
        'email_uzivatela',
        'uzivatelske_meno',
        'heslo_uzivatela',
        'rola_uzivatela',
    ];

    protected $hidden = [
        'heslo_uzivatela',
    ];

    // Define validation rules
    public static $rules = [
        'meno_uzivatela' => 'nullable|string',
        'priezvisko_uzivatela' => 'nullable|string',
        'tel_cislo_uzivatela' => 'nullable|string',
        'email_uzivatela' => 'nullable|string',
        'uzivatelske_meno' => 'nullable|string',
        'heslo_uzivatela' => 'nullable|string',
        'rola_uzivatela' => 'nullable|string',
    ];
}
