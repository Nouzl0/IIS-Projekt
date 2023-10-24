<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Linka extends Model
{
     // Set the table name
    protected $table = 'linka';

    // Set the primary key column
    protected $primaryKey = 'id_linka';

    // Define the fillable columns
    protected $fillable = [
        'cislo_linky',
        'vozidla_linky',
    ];

    // Define validation rules
    public static $rules = [
        'cislo_linky' => 'required|integer|unique:linka',
        'vozidla_linky' => 'required|string',
    ];
}
