<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::all();
        $categories = Category::all();

        if ($authors->count() === 0 || $categories->count() === 0) {
            $this->command->info('Authors or categories table is empty. Seed them first.');
            return;
        }

        $languages = ['English', 'Arabic', 'French'];
        $desc = fake()->paragraph();

        foreach (range(1, 20) as $i) {
            Book::create([
                'title' => "Sample Book $i",
                'language' => $languages[array_rand($languages)],
                'publication_year' => rand(1990, 2024),
                'available' => rand(0, 1),
                'description'=> $desc,
                'author_id' => $authors->random()->id,
                'category_id' => $categories->random()->id,
            ]);
        }
    }
}
