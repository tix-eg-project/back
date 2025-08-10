<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 12; $i++) {
            User::create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@user.com',
                'password' => Hash::make('password123'),
            ]);
        }
    }
}
