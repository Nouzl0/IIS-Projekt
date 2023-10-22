<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trasa extends Model
{
    protected $table = 'trasa'; // Set the table name
    protected $primaryKey = 'id_trasa'; // Set the primary key column

    // Define the fillable columns
    protected $fillable = [
        'meno_trasy',
        'info_trasy',
        'id_linka',
    ];

    // Define validation rules
    public static $rules = [
        'meno_trasy' => 'nullable|string',
        'info_trasy' => 'nullable|string',
        'id_linka' => 'required|integer'
    ];

    // Define the relationship with the "Linka" table
    public function linka()
    {
        return $this->belongsTo(Linka::class, 'id_linka', 'id_linka');
    }
}
