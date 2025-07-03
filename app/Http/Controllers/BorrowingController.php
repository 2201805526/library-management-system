<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Support\Facades\DB;
use App\Models\Fine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function showAll(){
        $borrowings = Borrowing::with(['user', 'book', 'fine'])->get();
        return view('borrowings.index', compact('borrowings'));
    }

    public function showMy(String $id){
        $borrowings = Borrowing::with(['user', 'book', 'fine'])->findOrFail($id)->get();

        return view('borrowings.my', compact('borrowings'));
    }

    public function return (String $id){

        $borrowings = Borrowing::with(['user', 'book', 'fine'])->findOrFail($id)->get();
        $borrowing = Borrowing::findOrFail($id);

        if(!$borrowing->returned_at){
            $borrowing->returned_at = now();
            $borrowing->book->available = true;
            $borrowing->save();

            $fineAmount = $borrowing->calculateFine();

            if ($fineAmount > 0) {
                Fine::create([
                    'borrowing_id' => $borrowing->id,
                    'amount' => $fineAmount,
                    'isPaid' => false,
            ]);
        }
        }

        return redirect()->route('show.my.borrowings', compact('borrowings'))->with('success', 'Book returned successfully 📚');
    }

    
}
