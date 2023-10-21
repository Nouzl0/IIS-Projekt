<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Udrzba extends Model
{
    // Set table name
    protected $table = 'Údržba';

    // Define primary key
    protected $primaryKey = 'id_údržba';
    public $timestamps = false;

    // Define fillable columns
    protected $fillable = [
        'začiatok_údržby',
        'id_vozidlo',
        'id_uživateľ_správca',
    ];

    // Define validation rules
    public static $rules = [
        'začiatok_údržby' => 'nullable|date',
        'id_vozidlo' => 'required|integer',
        'id_uživateľ_správca' => 'required|integer',
    ];

    // Define relationships
    public function vozidlo()
    {
        return $this->belongsTo(Vozidlo::class, 'id_vozidlo', 'id_vozidlo');
    }

    public function spravca()
    {
        return $this->belongsTo(Uzivatel::class, 'id_uživateľ_správca', 'id_uživateľ');
    }
}
