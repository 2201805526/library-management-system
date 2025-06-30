<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrowing_id',
        'amount',
        'paid',
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }


    public function returnBook($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->returned_at = now();
        $borrowing->save();

        $fineAmount = $borrowing->calculateFine();

        if ($fineAmount > 0) {
            Fine::create([
                'borrowing_id' => $borrowing->id,
                'amount' => $fineAmount,
                'isPaid' => false,
            ]);
        }

        return redirect()->back()->with('success', 'تم إرجاع الكتاب' . ($fineAmount > 0 ? ' مع غرامة' : ''));
    }
}
