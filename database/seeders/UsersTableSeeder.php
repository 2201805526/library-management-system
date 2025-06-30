<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@lib.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // Librarian
        User::create([
            'name' => 'Librarian User',
            'email' => 'librarian@lib.com',
            'role' => 'librarian',
            'password' => Hash::make('password')

        ]);

        // Students
        User::factory()->count(10)->create([
            'role' => 'student'
        ]);

    }
}
