<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::inRandomOrder()->value('id') ?? Order::factory(),
            'product_id' => Product::inRandomOrder()->value('id') ?? Product::factory(),
            'quantity' => 1,
            'total_price' => Product::inRandomOrder()->value('price'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
