<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uzivatel extends Model
{
    // Set table name
    protected $table = 'Uživateľ';

    // Define primary key
    protected $primaryKey = 'id_uživateľ';
    public $timestamps = false;

    // Define fillable columns
    protected $fillable = [
        'meno_uživateľa',
        'priezvisko_uživateľa',
        'tel_číslo_uživateľa',
        'heslo_uživateľa',
        'rola_uživateľa',
    ];

    // Define validation rules
    public static $rules = [
        'meno_uživateľa' => 'nullable|string',
        'priezvisko_uživateľa' => 'nullable|string',
        'tel_číslo_uživateľa' => 'nullable|string',
        'heslo_uživateľa' => 'nullable|string',
        'rola_uživateľa' => 'nullable|string',
    ];
}
