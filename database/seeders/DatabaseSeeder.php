<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSedder;
use Database\Seeders\MemberSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSedder::class,
            MemberSeeder::class,
            CategorySeeder::class,
        ]);
    }
}
