<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarif>
 */
class TarifFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'daya' => $this->faker->randomElement(['900 VA', '1300 VA', '2200 VA', '3500 VA']),
            'tarifperkwh' => $this->faker->numberBetween(1000, 2000),
        ];
    }
}
