<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['username' => 'chaa', 'full_name' => 'Chaeza Ibnu Akbar', 'email' => 'chaezaibnuakbar@gmail.com', 'no_telp' => '081234567890', 'role' => 'admin'],
            ['username' => 'admin2', 'full_name' => 'Admin Two', 'email' => 'admin2@gmail.com', 'no_telp' => '081234567891', 'role' => 'admin'],
            ['username' => 'admin3', 'full_name' => 'Admin Three', 'email' => 'admin3@gmail.com', 'no_telp' => '081234567892', 'role' => 'admin'],
            ['username' => 'kasir1', 'full_name' => 'Kasir One', 'email' => 'kasir1@gmail.com', 'no_telp' => '081234567893', 'role' => 'kasir'],
            ['username' => 'kasir2', 'full_name' => 'Kasir Two', 'email' => 'kasir2@gmail.com', 'no_telp' => '081234567894', 'role' => 'kasir'],
            ['username' => 'kasir3', 'full_name' => 'Kasir Three', 'email' => 'kasir3@gmail.com', 'no_telp' => '081234567895', 'role' => 'kasir'],
            ['username' => 'kasir4', 'full_name' => 'Kasir Four', 'email' => 'kasir4@gmail.com', 'no_telp' => '081234567896', 'role' => 'kasir'],
            ['username' => 'kasir5', 'full_name' => 'Kasir Five', 'email' => 'kasir5@gmail.com', 'no_telp' => '081234567897', 'role' => 'kasir'],
            ['username' => 'kasir6', 'full_name' => 'Kasir Six', 'email' => 'kasir6@gmail.com', 'no_telp' => '081234567898', 'role' => 'kasir'],
            ['username' => 'kasir7', 'full_name' => 'Kasir Seven', 'email' => 'kasir7@gmail.com', 'no_telp' => '081234567899', 'role' => 'kasir'],
        ];

        foreach ($users as $userData) {
            User::create(array_merge($userData, [
                'password' => "password",
                'created_at' => Carbon::now()->subMonths(rand(1, 8)),
                'updated_at' => Carbon::now(),
            ]));
        }

        $userCount = User::count();
        $this->command->info("Successfully added {$userCount} users to the database.");
    }
}
