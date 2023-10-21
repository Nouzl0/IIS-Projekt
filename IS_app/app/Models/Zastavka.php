<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zastavka extends Model
{
    protected $table = 'Zastávka'; // Set the table name
    protected $primaryKey = 'id_zastávka'; // Set the primary key column

    // Define the fillable columns
    protected $fillable = [
        'meno_zastávky',
        'adresa_zastávky',
    ];

    // Define validation rules
    public static $rules = [
        'meno_zastávky' => 'nullable|string',
        'adresa_zastávky' => 'nullable|string'
    ];

    // Disable timestamps if not needed
    public $timestamps = false;
}
