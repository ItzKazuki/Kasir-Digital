<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'category_id' => rand(1, 10), // Asumsikan ada 5 kategori
            'discount_id' => rand(1, 5), // Asumsikan ada 3 diskon
            'price' => $this->faker->randomFloat(2, 1000, 50000),
            'stock' => $this->faker->numberBetween(1, 100),
            'image_url' => $this->faker->imageUrl(),
            'description' => $this->faker->sentence()
        ];
    }
}
