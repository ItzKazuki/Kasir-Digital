<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryProductSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert categories
        $categories = [
            ['name' => 'Makanan', 'description' => 'Makanan ringan dan berat'],
            ['name' => 'Minuman', 'description' => 'Berbagai jenis minuman'],
            ['name' => 'Elektronik', 'description' => 'Barang elektronik'],
            ['name' => 'Perlengkapan', 'description' => 'Barang kebutuhan harian'],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Insert products
        $products = [
            ['name' => 'Nasi Goreng', 'category_id' => 1, 'stock' => 50, 'price' => 20000, 'description' => 'Nasi goreng spesial'],
            ['name' => 'Ayam Geprek', 'category_id' => 1, 'stock' => 40, 'price' => 25000, 'description' => 'Ayam geprek pedas'],
            ['name' => 'Es Teh Manis', 'category_id' => 2, 'stock' => 100, 'price' => 5000, 'description' => 'Es teh manis segar'],
            ['name' => 'Kopi Hitam', 'category_id' => 2, 'stock' => 80, 'price' => 10000, 'description' => 'Kopi hitam tanpa gula'],
            ['name' => 'Headphone', 'category_id' => 3, 'stock' => 20, 'price' => 150000, 'description' => 'Headphone kualitas tinggi'],
            ['name' => 'Charger HP', 'category_id' => 3, 'stock' => 30, 'price' => 50000, 'description' => 'Charger HP fast charging'],
            ['name' => 'Sikat Gigi', 'category_id' => 4, 'stock' => 150, 'price' => 7000, 'description' => 'Sikat gigi dengan bulu lembut'],
            ['name' => 'Sabun Mandi', 'category_id' => 4, 'stock' => 100, 'price' => 12000, 'description' => 'Sabun mandi wangi segar'],
        ];

        foreach ($products as $productData) {
            Product::create(array_merge($productData, ['discount_id' => null, 'image_url' => null]));
        }
    }
}
