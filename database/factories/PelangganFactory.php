<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggan>
 */
class PelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->userName(),
            'password' => Hash::make('password'),
            'nomor_kwh' => $this->faker->unique()->numerify('##########'),
            'nama_pelanggan' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'id_tarif' => \App\Models\Tarif::factory(),
        ];
    }
}
