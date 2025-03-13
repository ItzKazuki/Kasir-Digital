<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSedder;
use Database\Seeders\MemberSedder;
use Database\Seeders\TransactionSedder;
use Database\Seeders\CategoryProductSedder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSedder::class,
            CategoryProductSedder::class,
            MemberSedder::class,
            TransactionSedder::class,
        ]);
    }
}
