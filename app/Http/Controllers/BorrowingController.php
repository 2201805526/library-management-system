<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Fine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;

class BorrowingController extends Controller
{
    public function showAll(){
        $borrowings = Borrowing::with(['user', 'book', 'fine'])->get();
        return view('borrowings.index', compact('borrowings'));
    }

    public function showHistory(){

        $borrowings = Borrowing::whereNotNull('returned_at')->with(['user', 'book', 'fine'])->get();
        return view('borrowings.history', compact('borrowings'));
    }

    public function showMyHistory(){
        $borrowings = Borrowing::whereNotNull('returned_at')->with(['user', 'book', 'fine'])->get();
        return view('borrowings.myHistory', compact('borrowings'));
    }

    public function showMy(String $id){
        $borrowings = Borrowing::findOrFail($id)->with(['user', 'book', 'fine'])->get();

        return view('borrowings.my', compact('borrowings'));
    }

    public function return (String $id){

        $userId = Auth::user()->id;
        $borrowing = Borrowing::findOrFail($id);

        if(isNull($borrowing->returned_at)){
            $borrowing->returned_at = now();
            $borrowing->book->available = true;
            $borrowing->book->save();
            $borrowing->save();

            $fineAmount = $borrowing->calculateFine();

            if ($fineAmount > 0) {
                Fine::create([
                    'borrowing_id' => $borrowing->id,
                    'amount' => $fineAmount,
                    'isPaid' => false,
            ])->save();
        }
        }

        return redirect()->route('show.my.borrowings', $userId)->with('success', 'Book returned successfully 📚');
    }


}
