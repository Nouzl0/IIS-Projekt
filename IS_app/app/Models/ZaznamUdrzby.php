<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZaznamUdrzby extends Model
{
    // Set table name
    protected $table = 'Záznam údržby';

    // Define primary keys
    protected $primaryKey = ['id_údržba', 'id_uživateľ_technik'];

    // Disable auto-incrementing for the primary key
    public $incrementing = false;

    public $timestamps = false;

    public static $rules = [
        'id_údržba' => 'required|integer',
        'id_uživateľ_technik' => 'required|integer',
    ];

    // Define relationships
    public function udrzba()
    {
        return $this->belongsTo(Udrzba::class, 'id_údržba', 'id_údržba');
    }

    public function technik()
    {
        return $this->belongsTo(Uzivatel::class, 'id_uživateľ_technik', 'id_uživateľ');
    }
}
