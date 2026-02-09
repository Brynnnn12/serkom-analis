<?php

namespace Database\Factories;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembayaran>
 */
class PembayaranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pembayaran::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_tagihan' => Tagihan::factory(),
            'tanggal_pembayaran' => $this->faker->date(),
            'bulan_bayar' => $this->faker->numberBetween(1, 12),
            'biaya_admin' => $this->faker->numberBetween(1000, 5000),
            'total_bayar' => $this->faker->numberBetween(50000, 200000),
            'id_user' => User::factory(),
        ];
    }
}
