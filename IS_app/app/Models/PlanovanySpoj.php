<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanovanySpoj extends Model
{
    // Set table name
    protected $table = 'Plánovaný spoj';

    // Define primary key
    protected $primaryKey = 'id_plán_trasy';
    public $timestamps = false;

    // Define fillable columns
    protected $fillable = [
        'začiatok_trasy',
        'id_trasa',
        'id_vozidlo',
        'id_uživateľ_dispečer',
        'id_uživateľ_šofér',
    ];

    // Define validation rules
    public static $rules = [
        'začiatok_trasy' => 'nullable|date',
        'id_trasa' => 'required|integer',
        'id_vozidlo' => 'required|integer',
        'id_uživateľ_dispečer' => 'required|integer',
        'id_uživateľ_šofér' => 'required|integer',
    ];

    // Define relationships
    public function trasa()
    {
        return $this->belongsTo(Trasa::class, 'id_trasa', 'id_linka');
    }

    public function vozidlo()
    {
        return $this->belongsTo(Vozidlo::class, 'id_vozidlo', 'id_vozidlo');
    }

    public function dispecer()
    {
        return $this->belongsTo(Uzivatel::class, 'id_uživateľ_dispečer', 'id_uživateľ');
    }

    public function sofer()
    {
        return $this->belongsTo(Uzivatel::class, 'id_uživateľ_šofér', 'id_uživateľ');
    }
}
