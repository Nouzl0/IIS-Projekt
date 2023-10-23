<?php

namespace Database\Factories;

use App\Models\Udrzba;
use App\Models\Uzivatel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Zaznam_udrzby>
 */
class Zaznam_udrzbyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        
        return [
            'id_udrzba' => Udrzba::Factory(),
            'id_uzivatel_technik' => Uzivatel::Factory()
            // datum, cas kde?
        ];
    }
}
