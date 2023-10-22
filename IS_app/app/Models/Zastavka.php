<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zastavka extends Model
{
    protected $table = 'zastavka'; // Set the table name
    protected $primaryKey = 'id_zastavka'; // Set the primary key column

    // Define the fillable columns
    protected $fillable = [
        'meno_zastavky',
        'adresa_zastavky',
    ];

    // Define validation rules
    public static $rules = [
        'meno_zastavky' => 'nullable|string',
        'adresa_zastavky' => 'nullable|string'
    ];

}
