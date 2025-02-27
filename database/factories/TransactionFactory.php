<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order = Order::inRandomOrder()->first() ?? Order::factory()->create();

        return [
            'order_id' => $order->id,
            'member_id' => Member::inRandomOrder()->value('id') ?? Member::factory(),
            'total_price' => $order->total_price, // Menggunakan total dari order terkait
            'payment_method' => $this->faker->randomElement(['cash', 'debit', 'credit', 'ewallet']),
            'payment_status' => $this->faker->randomElement(['paid', 'unpaid', 'pending']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
