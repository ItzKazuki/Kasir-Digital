<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
            ['name' => 'Kaos Polos', 'category_id' => 5, 'stock' => 200, 'price' => 50000, 'description' => 'Kaos polos nyaman untuk sehari-hari'],
            ['name' => 'Jaket Kulit', 'category_id' => 5, 'stock' => 30, 'price' => 300000, 'description' => 'Jaket kulit berkualitas tinggi'],
            ['name' => 'Lipstik', 'category_id' => 6, 'stock' => 100, 'price' => 80000, 'description' => 'Lipstik tahan lama dengan berbagai warna'],
            ['name' => 'Pembersih Wajah', 'category_id' => 6, 'stock' => 60, 'price' => 50000, 'description' => 'Pembersih wajah untuk kulit sensitif'],
            ['name' => 'Sepatu Lari', 'category_id' => 7, 'stock' => 40, 'price' => 400000, 'description' => 'Sepatu lari ringan dan nyaman'],
            ['name' => 'Bola Basket', 'category_id' => 7, 'stock' => 25, 'price' => 150000, 'description' => 'Bola basket berkualitas tinggi'],
            ['name' => 'Novel Fiksi', 'category_id' => 8, 'stock' => 70, 'price' => 90000, 'description' => 'Novel fiksi menarik untuk dibaca'],
            ['name' => 'Buku Masak', 'category_id' => 8, 'stock' => 50, 'price' => 120000, 'description' => 'Buku masak dengan berbagai resep'],
            ['name' => 'Mobil Mainan', 'category_id' => 9, 'stock' => 150, 'price' => 30000, 'description' => 'Mobil mainan untuk anak-anak'],
            ['name' => 'Puzzle Kayu', 'category_id' => 9, 'stock' => 80, 'price' => 50000, 'description' => 'Puzzle kayu edukatif untuk anak'],
            ['name' => 'Meja Makan', 'category_id' => 10, 'stock' => 20, 'price' => 1500000, 'description' => 'Meja makan kayu solid'],
            ['name' => 'Kursi Santai', 'category_id' => 10, 'stock' => 15, 'price' => 800000, 'description' => 'Kursi santai yang nyaman untuk bersantai'],
        ];

        foreach ($products as $productData) {
            Product::create(array_merge($productData, ['discount_id' => null, 'image_url' => null]));
        }

        $productCount = Product::count();

        $this->command->info("Successfully added {$productCount} products to the database.");

    }
}
