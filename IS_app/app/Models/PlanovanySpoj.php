<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanovanySpoj extends Model
{
    // Set table name
    protected $table = 'planovany_spoj';

    // Define primary key
    protected $primaryKey = 'id_plan_trasy';

    // Define fillable columns
    protected $fillable = [
        'zaciatok_trasy',
        'id_trasa',
        'id_vozidlo',
        'id_uzivatel_dispecer',
        'id_uzivatel_sofer',
        'opakovanie',
        'platny_do',
    ];

    // Define validation rules
    public static $rules = [
        'zaciatok_trasy' => 'nullable|dateTime',
        'id_trasa' => 'required|integer',
        'id_vozidlo' => 'required|integer',
        'id_uzivatel_dispecer' => 'required|integer',
        'id_uzivatel_sofer' => 'required|integer',
        'opakovanie' => 'required|string',
        'platny_do' => 'required|dateTime'
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
        return $this->belongsTo(Uzivatel::class, 'id_uzivatel_dispecer', 'id_uzivatel');
    }

    public function sofer()
    {
        return $this->belongsTo(Uzivatel::class, 'id_uzivatel_sofer', 'id_uzivatel');
    }
}
