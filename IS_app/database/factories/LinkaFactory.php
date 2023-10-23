<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Linka>
 */
class LinkaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        
        return [
            'id_linka' => $this->faker->id_linka(),
            'cislo_linky' => $this->faker->cislo_linky(),
            'meno_linky' => $this->faker->meno_linky()
        ];
    }
}
