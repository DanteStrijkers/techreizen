<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'test@testing.test',
                'password' => bcrypt('test'),
            ],
            [
                'email' => 'traveller@example.com',
                'role' => 'traveller',
            ],
            [
                'email' => 'guide@example.com',
                'role' => 'guide',
            ],
            [
                'email' => 'admin@example.com',
                'role' => 'admin',
            ],
        ];

        foreach ($users as $user) {
            User::factory()->create($user);
        }
    }
}
