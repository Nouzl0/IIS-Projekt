<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Udrzba extends Model
{
    // Set table name
    protected $table = 'udrzba';

    // Define primary key
    protected $primaryKey = 'id_udrzba';

    // Define fillable columns
    protected $fillable = [
        'zaciatok_udrzby',
        'id_vozidlo',
        'id_uzivatel_spravca',
    ];

    // Define validation rules
    public static $rules = [
        'zaciatok_udrzby' => 'nullable|date',
        'id_vozidlo' => 'required|integer',
        'id_uzivatel_spravca' => 'required|integer',
    ];

    // Define relationships
    public function vozidlo()
    {
        return $this->belongsTo(Vozidlo::class, 'id_vozidlo', 'id_vozidlo');
    }

    public function spravca()
    {
        return $this->belongsTo(Uzivatel::class, 'id_uzivatel_spravca', 'id_uzivatel');
    }
}