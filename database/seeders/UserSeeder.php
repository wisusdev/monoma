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
        User::create([
            'username' => 'tester',
            'password' => bcrypt('PASSWORD'),
            'last_login' => now(),
            'is_active' => true,
            'role' => 'manager',
        ]);

        User::factory(1)->create();
    }
}
