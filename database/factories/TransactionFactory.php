<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Member;
use App\Models\OrderDetail;
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

        // Check if the order has order details, if not, create some
        if ($order->orderDetails()->count() == 0) {
            $order->orderDetails()->createMany(
            OrderDetail::factory()->count($this->faker->numberBetween(1, 5))->make()->toArray()
            );
            // Recalculate total price after adding order details
            $order->total_price = $order->orderDetails->sum('total_price');
            $order->save();
        }

        $cash = $this->faker->numberBetween($order->total_price + 100000, $order->total_price + 250000);

        return [
            'order_id' => $order->id,
            'member_id' => Member::inRandomOrder()->value('id') ?? Member::factory(),
            'total_price' => $order->total_price, // Menggunakan total dari order terkait
            'payment_method' => 'cash',
            'payment_status' => $this->faker->randomElement(['paid', 'unpaid', 'pending']),
            'cash' => $cash,
        ];
    }
}
