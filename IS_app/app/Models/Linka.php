<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Linka extends Model
{
     // Set the table name
    protected $table = 'Linka';

    // Set the primary key column
    protected $primaryKey = 'id_linka';

    // Define the fillable columns
    protected $fillable = [
        'číslo_linky',
        'meno_linky',
    ];

    // Disable timestamps (created_at, updated_at)
    public $timestamps = false;

    // Define validation rules
    public static $rules = [
        'číslo_linky' => 'required|integer|unique:Linka',
        'meno_linky' => 'required|string',
    ];
}
