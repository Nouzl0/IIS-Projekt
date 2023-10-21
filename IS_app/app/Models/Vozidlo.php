<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vozidlo extends Model
{
    // Set table name
    protected $table = 'Vozidlo';

    // Define primary key
    protected $primaryKey = 'id_vozidlo';
    public $timestamps = false;

    // Define fillabel columns
    protected $fillable = [
        'názov',
        'druh_vozidla',
        'značka_vozidla',
    ];

    // Define validation rules
    public static $rules = [
        'názov' => 'nullable|string',
        'druh_vozidla' => 'nullable|string',
        'značka_vozidla' => 'nullable|string',
    ];
}
