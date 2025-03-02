<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MemberSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            ['full_name' => 'John Doe', 'no_telp' => '081234567890', 'email' => 'johndoe@example.com', 'point' => 120000, 'status' => 'active'],
            ['full_name' => 'Jane Smith', 'no_telp' => '081298765432', 'email' => 'janesmith@example.com', 'point' => 85000, 'status' => 'active'],
            ['full_name' => 'Michael Johnson', 'no_telp' => '081276543210', 'email' => 'michaelj@example.com', 'point' => 200000, 'status' => 'inactive'],
            ['full_name' => 'Emily Brown', 'no_telp' => '081265432109', 'email' => 'emilyb@example.com', 'point' => 150000, 'status' => 'active'],
            ['full_name' => 'David Wilson', 'no_telp' => '081254321098', 'email' => 'davidw@example.com', 'point' => 9500, 'status' => 'inactive'],
        ];

        foreach ($members as $memberData) {
            Member::create(array_merge($memberData, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }
}
