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
                'username' => 'pascale.b',
                'first_name' => 'Pascale',
                'last_name' => 'Bader',
                'email' => 'pascaletabet@cloudsp-lb.com',
                'password' => bcrypt('pascalebader'),
                'title' => 'Manager',
                'role' => 'admin',
                'employment_date' => '2025-09-01',
            ]
        );
        User::create(
            [
                'username' => 'ramy.b',
                'first_name' => 'Ramy',
                'last_name' => 'Bader',
                'email' => 'ramybader@cloudsp-lb.com',
                'password' => bcrypt('ramybader'),
                'title' => 'CEO',
                'role' => 'admin',
                'employment_date' => '2015-01-01',
            ]
        );
    }
}
