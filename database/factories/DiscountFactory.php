<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' Discount', // Nama diskon acak
            'type' => $this->faker->randomElement(['percentage', 'fixed']), // Pilih antara 2 jenis
            'value' => $this->faker->randomFloat(2, 5, 50), // Diskon antara 5% - 50% atau nominal
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+6 months'), // Berlaku 1-6 bulan ke depan
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
