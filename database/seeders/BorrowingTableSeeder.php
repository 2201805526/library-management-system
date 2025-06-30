<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BorrowingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $users = User::where('role', 'student')->get();
            $books = Book::all();

            if ($users->count() === 0 || $books->count() === 0) {
                $this->command->info('Users or books table is empty.');
                return;
            }

            foreach (range(1, 30) as $i) {
                $borrowedAt = Carbon::now()->subDays(rand(1, 30));
                $dueAt = (clone $borrowedAt)->addDays(14);
                $returnedAt = rand(0, 1) ? (clone $dueAt)->addDays(rand(1, 7)) : null;

                Borrowing::create([
                    'user_id' => $users->random()->id,
                    'book_id' => $books->random()->id,
                    'borrowed_at' => $borrowedAt,
                    'due_at' => $dueAt,
                    'returned_at' => $returnedAt,
                ]);
            }

    }
}
