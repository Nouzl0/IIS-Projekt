<?php

namespace Database\Factories;
use app\Models\Usek;
use app\Models\Zastavka;
use app\Models\Trasa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usek>
 */
class UsekFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        
        return [
            'poradie_useku' => $this->faker->poradie_useku(),
            'id_zastavka_zaciatok' => Zastavka::factory(),
            'id_zastavka_koniec' => Zastavka::factory(),
            'meno_useku' => $this->faker->meno_useku(),
            'dlzka_useku' => $this->faker->dlzka_useku(),
            'cas_useku' => $this->faker->cas_useku(),
            'id_trasa' => Trasa::factory()
        ];
    }
}
