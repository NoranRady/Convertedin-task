<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $connection = DB::connection('mysql');

        // Create 10,000 users
        $usersData = [];

        for ($i = 0; $i < 10000; $i++) {
            $usersData[] = [
                'name' => 'User ' . ($i + 1),
                'email' => 'user' . ($i + 1) . '@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ];
        }
        
        User::factory()->connection($connection)->createMany($usersData);

        // Create 100 admins
        $adminsData = [];
        for ($i = 0; $i < 100; $i++) {
            $adminsData[] = [
                'name' => 'Admin ' . ($i + 1),
                'email' => 'admin' . ($i + 1) . '@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'is_admin' => true,
                'remember_token' => Str::random(10),
            ];
        }
        
        $connection->table('users')->insert($adminsData);
    }
}
