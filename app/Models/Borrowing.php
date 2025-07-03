<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'due_at',
        'returned_at',
    ];

    protected $casts = [
        'borrowed_at' => 'datetime',
        'due_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    // for relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // for relations
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    // for relations
    public function fine()
    {
        return $this->hasOne(Fine::class);
    }

    public function calculateFine()
    {
        $returned = $this->returned_at ?? now();
        $due = $this->due_at;

        if ($returned->gt($due)) {
            $daysLate = $returned->diffInDays($due);
            $rate = 0.50;
            return $daysLate * $rate;
        }

        return 0;
    }

    public function currentBorrowingUser(){
        return $this->hasOne(Borrowing::class)->whereNull('returned_at');
    }
}
