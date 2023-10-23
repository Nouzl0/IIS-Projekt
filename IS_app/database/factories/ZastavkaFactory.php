<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Zastavka>
 */
class ZastavkaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        
        return [
            'id_zastavka' => $this->faker->id_zastavka(),
            'meno_zastavky' => $this->faker->meno_zastavky(),
            'adresa_zastavky' => $this->faker->adresa_zastavky()
        ];
    }
}
