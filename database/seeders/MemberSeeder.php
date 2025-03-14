<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            ['full_name' => 'Budi Santoso', 'no_telp' => '081234567890', 'email' => 'budi.santoso@gmail.com', 'point' => 120000, 'status' => 'active'],
            ['full_name' => 'Siti Aisyah', 'no_telp' => '081298765432', 'email' => 'siti.aisyah@yahoo.com', 'point' => 85000, 'status' => 'active'],
            ['full_name' => 'Andi Prasetyo', 'no_telp' => '081276543210', 'email' => 'andi.prasetyo@outlook.com', 'point' => 200000, 'status' => 'inactive'],
            ['full_name' => 'Dewi Lestari', 'no_telp' => '081265432109', 'email' => 'dewi.lestari@gmail.com', 'point' => 150000, 'status' => 'active'],
            ['full_name' => 'Rudi Hartono', 'no_telp' => '081254321098', 'email' => 'rudi.hartono@yahoo.com', 'point' => 9500, 'status' => 'inactive'],
            ['full_name' => 'Nina Sari', 'no_telp' => '081245678901', 'email' => 'nina.sari@outlook.com', 'point' => 30000, 'status' => 'active'],
            ['full_name' => 'Joko Widodo', 'no_telp' => '081234567891', 'email' => 'joko.widodo@gmail.com', 'point' => 50000, 'status' => 'active'],
            ['full_name' => 'Rina Amelia', 'no_telp' => '081223344556', 'email' => 'rina.amelia@yahoo.com', 'point' => 120000, 'status' => 'inactive'],
            ['full_name' => 'Toni Kurniawan', 'no_telp' => '081212345678', 'email' => 'toni.kurniawan@outlook.com', 'point' => 250000, 'status' => 'active'],
            ['full_name' => 'Lina Marlina', 'no_telp' => '081201234567', 'email' => 'lina.marlina@gmail.com', 'point' => 75000, 'status' => 'active'],
            ['full_name' => 'Fajar Nugraha', 'no_telp' => '081290123456', 'email' => 'fajar.nugraha@yahoo.com', 'point' => 180000, 'status' => 'inactive'],
            ['full_name' => 'Sari Indah', 'no_telp' => '081298765431', 'email' => 'sari.indah@outlook.com', 'point' => 220000, 'status' => 'active'],
            ['full_name' => 'Agus Salim', 'no_telp' => '081276543211', 'email' => 'agus.salim@gmail.com', 'point' => 95000, 'status' => 'active'],
            ['full_name' => 'Diana Putri', 'no_telp' => '081265432108', 'email' => 'diana.putri@yahoo.com', 'point' => 50000, 'status' => 'inactive'],
            ['full_name' => 'Eko Prabowo', 'no_telp' => '081254321097', 'email' => 'eko.prabowo@outlook.com', 'point' => 130000, 'status' => 'active'],
            ['full_name' => 'Rina Wulandari', 'no_telp' => '081243210987', 'email' => 'rina.wulandari@gmail.com', 'point' => 90000, 'status' => 'active'],
            ['full_name' => 'Dani Saputra', 'no_telp' => '081232109876', 'email' => 'dani.saputra@yahoo.com', 'point' => 110000, 'status' => 'inactive'],
            ['full_name' => 'Nadia Rahmawati', 'no_telp' => '081221098765', 'email' => 'nadia.rahmawati@outlook.com', 'point' => 140000, 'status' => 'active'],
            ['full_name' => 'Rizky Aditya', 'no_telp' => '081210987654', 'email' => 'rizky.aditya@gmail.com', 'point' => 160000, 'status' => 'inactive'],
            ['full_name' => 'Cindy Lestari', 'no_telp' => '081209876543', 'email' => 'cindy.lestari@yahoo.com', 'point' => 70000, 'status' => 'active'],
            ['full_name' => 'Fahmi Hidayat', 'no_telp' => '081198765432', 'email' => 'fahmi.hidayat@outlook.com', 'point' => 190000, 'status' => 'active'],
            ['full_name' => 'Siti Nurhaliza', 'no_telp' => '081187654321', 'email' => 'siti.nurhaliza@gmail.com', 'point' => 30000, 'status' => 'inactive'],
            ['full_name' => 'Yusuf Maulana', 'no_telp' => '081176543210', 'email' => 'yusuf.maulana@yahoo.com', 'point' => 120000, 'status' => 'active'],
            ['full_name' => 'Lutfi Ramadhan', 'no_telp' => '081165432109', 'email' => 'lutfi.ramadhan@outlook.com', 'point' => 80000, 'status' => 'active'],
            ['full_name' => 'Dewi Anggraini', 'no_telp' => '081154321098', 'email' => 'dewi.anggraini@gmail.com', 'point' => 95000, 'status' => 'inactive'],
            ['full_name' => 'Hendra Setiawan', 'no_telp' => '081143210987', 'email' => 'hendra.setiawan@yahoo.com', 'point' => 110000, 'status' => 'active'],
            ['full_name' => 'Maya Sari', 'no_telp' => '081132109876', 'email' => 'maya.sari@outlook.com', 'point' => 130000, 'status' => 'active'],
        ];

        foreach ($members as $memberData) {
            Member::create(array_merge($memberData, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }
}
