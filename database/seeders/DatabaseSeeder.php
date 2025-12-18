<?php

namespace Database\Seeders;

use App\Models\Magang;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $userMagang = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'magang'
        ]);

        $userMagang = User::create([
            'name' => 'KHAY',
            'email' => 'khay@example.com',
            'password' => bcrypt('password'),
            'role' => 'magang'
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        Magang::create([
            'user_id' => $userMagang->id, // 🔥 INI KUNCI UTAMA
            'nama' => 'Test User',
            'email' => 'test@example.com',
            'asal_instansi' => 'Universitas KHAY',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addMonths(3),
            'status' => 'aktif'
        ]);

        Magang::create([
            'user_id' => $userMagang->id,
            'nama' => 'KHAY',
            'email' => 'khay@example.com',
            'asal_instansi' => 'Universitas KOTA',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addMonths(3),
            'status' => 'aktif'
        ]);
    }
}

