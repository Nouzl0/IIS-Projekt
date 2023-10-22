<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usek extends Model
{
    protected $table = 'usek'; // Set the table name

    // Define the primary key columns
    protected $primaryKey = ['poradie_useku', 'id_zastavka_zaciatok', 'id_zastavka_koniec', 'id_trasa'];

    // Disable auto-incrementing for the primary key
    public $incrementing = false;

    // Define the fillable columns
    protected $fillable = [
        'poradie_useku',
        'id_zastavka_zaciatok',
        'id_zastavka_koniec',
        'meno_useku',
        'dlzka_useku',
        'cas_useku',
        'usekcol',
        'id_trasa',
    ];

    // Define validation rules
    public static $rules = [
        'poradie_useku' => 'required|integer',
        'id_zastavka_zaciatok' => 'required|integer',
        'id_zastavka_koniec' => 'required|integer',
        'meno_useku' => 'required|string',
        'dlzka_useku'=> 'nullable|string',
        'cas_useku'=> 'required|date_format:H:i:s',
        'usekcol'=> 'nullable|string',
        'id_trasa'=> 'required|integer'
    ];

    // Define the relationships with other tables
    public function zastavkaZaciatok()
    {
        return $this->belongsTo(Zastavka::class, 'id_zastavka_zaciatok', 'id_zastavka');
    }

    public function zastavkaKoniec()
    {
        return $this->belongsTo(Zastavka::class, 'id_zastavka_koniec', 'id_zastavka');
    }

    public function trasa()
    {
        return $this->belongsTo(Trasa::class, 'id_trasa', 'id_trasa');
    }
}
