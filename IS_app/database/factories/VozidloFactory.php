<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vozidlo>
 */
class VozidloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $druh_vozidla = $this->faker->randomElement('autobus', 'elektricka', 'trolejbus');
        
        return [
            'id_vozidlo' => $this->faker->id_vozidlo(),
            'nazov' => $this->faker->nazov(),
            'druh_vozidla' => $druh_vozidla,
            'znacka_vozidla' => $this->faker->meno_linky()
        ];
    }
}
