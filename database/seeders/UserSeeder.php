<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('adminpassword'), // mengenkripsi password
                'phone' => '081234567890',
                'role' => 'admin', // role admin
                'user_image' => 'default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Member User',
                'email' => 'member@example.com',
                'password' => bcrypt('memberpassword'), // mengenkripsi password
                'phone' => '089876543210',
                'role' => 'member', // role member
                'user_image' => 'default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // insert data ke database
        foreach ($data as $user) {
            User::create($user);
        }
    }
}
