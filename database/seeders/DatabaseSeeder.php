<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSedder;
use Database\Seeders\MemberSeeder;
use Database\Seeders\TransactionSedder;
use Database\Seeders\CategoryProductSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSedder::class,
            CategoryProductSeeder::class,
            MemberSeeder::class,
            TransactionSedder::class,
        ]);
    }
}
