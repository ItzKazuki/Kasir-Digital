<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Member;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Transaction;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        ]);

        Order::factory()
            ->count(10)
            ->create();
        OrderDetail::factory()
            ->count(30)
            ->create();
        Transaction::factory()
            ->count(10)
            ->create();
    }
}
