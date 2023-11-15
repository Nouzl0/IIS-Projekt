<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vozidlo extends Model
{
    // Set table name
    protected $table = 'vozidlo';

    // Define primary key
    protected $primaryKey = 'id_vozidlo';

    // Define fillabel columns
    protected $fillable = [
        'nazov',
        'spz',
        'druh_vozidla',
        'znacka_vozidla',
    ];

    // Define validation rules
    public static $rules = [
        'nazov' => 'nullable|string',
        'spz' => 'required|string',
        'druh_vozidla' => 'nullable|string',
        'znacka_vozidla' => 'nullable|string',
    ];
}
