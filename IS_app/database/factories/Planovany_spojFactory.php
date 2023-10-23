<?php

namespace Database\Factories;

use App\Models\Trasa;
use App\Models\Uzivatel;
use App\Models\Vozidlo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlanovanySpoj>
 */
class PlanovanySpojFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        
        return [
            'id_plan_trasy' => $this->faker->id_plan_trasy(),
            'zaciatok_trasy' => $this->faker->zaciatok_trasy(),
            'id_trasa' => Trasa::Factory(),
            'id_vozidlo' => Vozidlo::Factory(),
            'id_uzivatel_dispecer' => Uzivatel::Factory(),
            'id_uzivatel_sofer' => Uzivatel::Factory()
        ];
    }
}
