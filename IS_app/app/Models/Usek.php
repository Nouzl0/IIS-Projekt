<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usek extends Model
{
    protected $table = 'Úsek'; // Set the table name

    // Define the primary key columns
    protected $primaryKey = ['poradie_úseku', 'id_zastávka_začiatok', 'id_zastávka_koniec', 'id_trasa'];

    // Disable auto-incrementing for the primary key
    public $incrementing = false;

    // Define the fillable columns
    protected $fillable = [
        'poradie_úseku',
        'id_zastávka_začiatok',
        'id_zastávka_koniec',
        'meno_úseku',
        'dĺžka_úseku',
        'cas_useku',
        'Úsekcol',
        'id_trasa',
    ];

    // Define validation rules
    public static $rules = [
        'poradie_úseku' => 'required|integer',
        'id_zastávka_začiatok' => 'required|integer',
        'id_zastávka_koniec' => 'required|integer',
        'meno_úseku' => 'required|string',
        'dĺžka_úseku'=> 'nullable|string',
        'cas_useku'=> 'required|date_format:H:i:s',
        'Úsekcol'=> 'nullable|string',
        'id_trasa'=> 'required|integer'
    ];

    // Disable timestamps if not needed
    public $timestamps = false;

    // Define the relationships with other tables
    public function zastavkaZaciatok()
    {
        return $this->belongsTo(Zastavka::class, 'id_zastávka_začiatok', 'id_zastávka');
    }

    public function zastavkaKoniec()
    {
        return $this->belongsTo(Zastavka::class, 'id_zastávka_koniec', 'id_zastávka');
    }

    public function trasa()
    {
        return $this->belongsTo(Trasa::class, 'id_trasa', 'id_trasa');
    }
}
