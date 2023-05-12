<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $connection = DB::connection('mysql_testing');

         // Insert users
         $users = [
            [
                'name' => 'user 1',
                'email' => 'user1@example.com',
                'is_admin' => false,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'user 2',
                'email' => 'user2@example.com',
                'is_admin' => false,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'admin 1',
                'email' => 'admin1@example.com',
                'is_admin' => true,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'admin 2',
                'email' => 'admin2@example.com',
                'is_admin' => true,
                'password' => bcrypt('password'),
            ],
        ];
        $connection->table('users')->insert($users);
        //Insert tasks
        $tasks = [
            [	
                'title' => 'task 1',
                'description' => 'task 1 description',
                'assigned_to_id' => 1,
                'assigned_by_id' => 3,

            ],
            [	
                'title' => 'task 2',
                'description' => 'task 2 description',
                'assigned_to_id' => 1,
                'assigned_by_id' => 3,
            ],
            [	
                'title' => 'task 3',
                'description' => 'task 3 description',
                'assigned_to_id' => 2,
                'assigned_by_id' => 3,
            ],
            [	
                'title' => 'task 4',
                'description' => 'task 4 description',
                'assigned_to_id' => 2,
                'assigned_by_id' => 3,
            ]
        ];
        $connection->table('tasks')->insert($tasks);
        // Insert statistics
        $statistics = [
            [	
                'user_id' => '1',
                'task_count' => '2'
            ],
            [	
                'user_id' => '2',
                'task_count' => '2'
            ]
        ];
        $connection->table('statistics')->insert($statistics);
    }
}
