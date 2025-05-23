<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Member;
use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory(),
            'order_date' => $this->faker->dateTimeBetween('-5 year', 'now'),
            'discount_id' => Discount::inRandomOrder()->value('id') ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}