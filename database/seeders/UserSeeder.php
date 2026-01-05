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
        User::create(
            [
                'username' => 'ramy.b',
                'first_name' => 'Ramy',
                'last_name' => 'Bader',
                'password' => bcrypt('CloudSP@2025'),
            ]
        );
        User::create(
            [
                'username' => 'georges.f',
                'first_name' => 'Georges',
                'last_name' => 'Fares',
                'password' => bcrypt('CloudSP@2024'),
            ]
        );
    }
}
