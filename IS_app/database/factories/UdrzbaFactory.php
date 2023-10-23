<?php

namespace Database\Factories;

use App\Models\Uzivatel;
use App\Models\Vozidlo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Udrzba>
 */
class UdrzbaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        
        return [
            'id_udrzba' => $this->faker->id_udrzba(),
            'zaciatok_udrzby' => $this->faker->zaciatok_udrzby(),
            'id_vozidlo' => Vozidlo::Factory(),
            'id_uzivatel_apravca' => Uzivatel::Factory()
        ];
    }
}
