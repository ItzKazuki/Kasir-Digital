<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
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
            ['name' => 'Pakaian', 'description' => 'Berbagai jenis pakaian'],
            ['name' => 'Kecantikan', 'description' => 'Produk kecantikan dan perawatan'],
            ['name' => 'Olahraga', 'description' => 'Peralatan dan perlengkapan olahraga'],
            ['name' => 'Buku', 'description' => 'Berbagai jenis buku dan literatur'],
            ['name' => 'Mainan', 'description' => 'Mainan untuk anak-anak'],
            ['name' => 'Perabotan', 'description' => 'Perabotan rumah tangga'],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        $categoryCount = Category::count();
        $this->command->info("Successfully added {$categoryCount} categories to the database.");
    }
}
