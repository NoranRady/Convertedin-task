<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create 10,000 users
        User::factory()->count(10000)->create();

        // Create 100 admins
        for ($i = 0; $i < 100; $i++) {
            User::create([
                'name' => 'Admin ' . ($i + 1),
                'email' => 'admin' . ($i + 1) . '@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'is_admin' => true,
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
