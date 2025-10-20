<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users with hashed passwords and unique emails
        $users = [
            [
                'name' => 'Maru',
                'email' => 'Maru@mail.com',
                'password' => Hash::make('password'),
                'role_id' => 1, // Admin role
                'created_at' => NOW(),
                'updated_at' => NOW()

            ],
            [
                'name' => 'San',
                'email' => 'San@mail.com',
                'password' => Hash::make('password'),
                'role_id' => 2, // Regular user role
                'created_at' => NOW(),
                'updated_at' => NOW()

            ],
            [
                'name' => 'Nana',
                'email' => 'Nana@mail.com',
                'password' => Hash::make('password'),
                'role_id' => 2, // Regular user role
                'created_at' => NOW(),
                'updated_at' => NOW()

            ],

            [
                'name' => 'Test User',
                'email' => 'test@examplemail.com',
                'password' => Hash::make('password'),
                'role_id' => 2, // Regular user role
                'created_at' => NOW(),
                'updated_at' => NOW()

            ]
        ];

        // Insert all users at once
        User::insert($users);
    }
}
