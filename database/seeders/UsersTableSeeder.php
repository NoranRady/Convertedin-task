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

        User::factory()->count(10000)->create();

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
        
        DB::table('users')->insert($adminsData);
    }
}
