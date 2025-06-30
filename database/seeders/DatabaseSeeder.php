<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UsersTableSeeder::class,
            AuthorsTableSeeder::class,
            CategoriesTableSeeder::class,
            BooksTableSeeder::class,
            BorrowingTableSeeder::class,
            FineTableSeeder::class,

        ]);
    }
}
