<?php

namespace Database\Seeders;

use App\Models\Borrowing;
use App\Models\Fine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $borrowings = Borrowing::whereNotNull('returned_at')->get();

        foreach ($borrowings as $borrowing) {
            $returnedAt = Carbon::parse($borrowing->returned_at);
            $dueAt = Carbon::parse($borrowing->due_at);

            if ($returnedAt->greaterThan($dueAt)) {
                $daysLate = $returnedAt->diffInDays($dueAt);
                $fineAmount = $daysLate * 0.5;

                Fine::create([
                    'borrowing_id' => $borrowing->id,
                    'amount' => $fineAmount,
                    'paid' => rand(0, 1),
                    // 'issued_at' is auto-filled using `useCurrent()`
                ]);
            }
        }
    }
}
