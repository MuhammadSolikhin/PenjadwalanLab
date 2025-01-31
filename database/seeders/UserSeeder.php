<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'priority' => 1
        ]);

        User::create([
            'name' => 'laboran',
            'email' => 'laboran@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'laboran',
            'priority' => 2
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'other',
            'priority' => 3
        ]);

        User::create([
            'name' => 'User 2',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'other',
            'priority' => 3
        ]);
    }
}
