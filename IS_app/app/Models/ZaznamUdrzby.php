<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZaznamUdrzby extends Model
{
    // Set table name
    protected $table = 'zaznam_udrzby';

    // Define primary keys
    protected $primaryKey = ['id_udrzba', 'id_uzivatel_technik'];

    // Disable auto-incrementing for the primary key
    public $incrementing = false;

    protected $fillable = [
        'id_udrzba',
        'id_uzivatel_technik',
    ];

    // Define validation rules
    public static $rules = [
        'id_udrzba' => 'required|integer',
        'id_uzivatel_technik' => 'required|integer',
    ];



    // Define relationships
    public function udrzba()
    {
        return $this->belongsTo(Udrzba::class, 'id_udrzba', 'id_udrzba');
    }

    public function technik()
    {
        return $this->belongsTo(Uzivatel::class, 'id_uzivatel_technik', 'id_uzivatel');
    }
}
