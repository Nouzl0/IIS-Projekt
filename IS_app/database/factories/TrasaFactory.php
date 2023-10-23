<?php

namespace Database\Factories;

use App\Models\Linka;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trasa>
 */
class TrasaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        
        return [
            'id_trasa' => $this->faker->id_trasa(),
            'meno_trasy' => $this->faker->meno_trasy(),
            'info_trasy' => $this->faker->info_trasy(),
            'id_linka' => Linka::Factory()
        ];
    }
}
