<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = [
        'title',
        'language',
        'publication_year',
        'description',
        'available',
        'author_id',
        'category_id',
    ];

    public function borrowings(){
        return $this->hasMany(Borrowing::class);
    }
    public function author(){
        return $this->belongsTo(Author::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function isAvailable()  {
        return !$this->borrowings()
                     ->whereNull('returned_at')
                     ->exists();
    }
}
