<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index(){
        $borrowings = Borrowing::with(['user', 'book', 'fine'])->get();
        return view('borrowings.index', compact('borrowings'));
    }
}
