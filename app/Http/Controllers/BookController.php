<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Fine;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(){
        $books = Book::with(['author', 'category'])->get();

        return view('books.index', compact('books'));
    }

    //show form to create a new book
    public function create(){
            $categories = Category::all();
            $authors = Author::all();

        return view('books.create', compact('authors', 'categories'));
    }

    //show single book's details
    public function show(String $id): View{

        $book = Book::findOrFail($id);
        return view('books.details', compact('book'));
    }

    // show form to edit an existing book
    public function edit(String $id){
        $book = Book::findOrFail($id);
        $categories = Category::all();
        $authors = Author::all();

        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    // store a new book
    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'language' => 'required|in:English,Arabic,French',
            'publication_year' => 'required|integer|digits:4',
            'available' => 'required|boolean',
            'description'=> 'nullable|text',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        //to create the book
        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function update(Request $request, String $id){

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'language' => 'required|in:English,Arabic,French',
            'publication_year' => 'required|integer|digits:4',
            'available' => 'required|boolean',
            'description'=> 'nullable|text',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        //to find the book
        $book = Book::findOrFail($id);

        //to update with the validated data
        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Book updated successfully! 🔃');
    }

    public function return(String $id ){
        $book = Book::findOrFail($id);

        $borrowing = $book->borrowings()
                    ->where('user_id', Auth::user()->id)
                    ->whereNull('returned_at')
                    ->first();

        if(!$borrowing){
            return back()->with('fail', 'You cannot return this book ❗');
        }
        $borrowing->update(['returned_at'=> now()]);
        $borrowing->update(['available'=> true]);

        $fineAmount = $borrowing->calculateFine();

        if ($fineAmount > 0) {
            Fine::create([
                'borrowing_id' => $borrowing->id,
                'amount' => $fineAmount,
                'isPaid' => false,
            ]);
        }

        return redirect()->route('books.index')->with('success', 'Book returned successfully 📚');
    }
    public function borrow(Request $request, String $id){


        $book = Book::findOrFail($id);
        if($book->available){
            $request->validate([
                'user_id'=> 'required|exists:users,id',
                'book_id'=> 'required|exists:books,id',
            ]);
            $borrowedAt = now();
            $dueAt = now()->addDays(14);

            Borrowing::create([
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'borrowed_at' => $borrowedAt,
                'due_at' => $dueAt,
                'returned_at' => null,
            ]);

            return redirect()->route('show.my.borrowings', $request->user_id)->with('success', 'Book\'s been added to your borrowings 📚');



        }else{
            return redirect()->route('show.my.borrowings', $request->user_id)->with('fail', 'sorry this book is not available ❗') ;
        }



    }
}
