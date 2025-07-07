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
use function PHPUnit\Framework\isNull;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'category'])->get();

        return view('books.index', compact('books'));
    }

    //show single book's details
    public function show(String $id): View
    {

        $book = Book::findOrFail($id);
        return view('books.details', compact('book'));
    }

    //show form to create a new book
    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();

        return view('books.create', compact( 'authors', 'categories'));
    }

    // store a new book
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'language' => 'required|in:English,Arabic,French',
            'publication_year' => 'required|integer|digits:4',
            'description' => 'nullable|string|max:1000',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        //to create the book
        Book::create([
            'title'=> $validated['title'],
            'language'=>$validated['language'],
            'publication_year' => $validated['publication_year'],
            'description'=>$validated['description'],
            'author_id'=> $validated['author_id'],
            'category_id'=>$validated['category_id'],
            'available'=> true,
        ]);

        return redirect()->route('books.index')->with('success', 'Book added successfully 📚❕');
    }

    // show form to edit an existing book
    public function edit(String $id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        $authors = Author::all();

        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    public function update(Request $request, String $id)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'language' => 'required|in:English,Arabic,French',
            'publication_year' => 'required|integer|digits:4',
            'available' => 'required|boolean',
            'description' => 'nullable|string|max:1000',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        //to find the book
        $book = Book::findOrFail($id);

        //to update with the validated data
        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Book updated successfully! 🔃');
    }

    public function destroy(String $id){
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully ❕');
    }

    public function return(String $id)
    {
        $userId = Auth::user()->id;
        $book = Book::findOrFail($id);

        $borrowing = $book->borrowings()
            ->where('user_id', $userId)
            ->whereNull('returned_at')
            ->first();

        if (isNull($borrowing)) {
            return back()->with('fail', 'You cannot return this book ❗');
        }

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

        return redirect()->route('books.index')->with('success', 'Book returned successfully 📚');
    }
    public function borrow(String $id)
    {

        $book = Book::findOrFail($id);
        $userId = Auth::user()->id;
        if ($book->available) {

            $borrowedAt = now();
            $dueAt = now()->addDays(14);
            $book->available = false;
            $book->save();

            Borrowing::create([
                'user_id' => $userId,
                'book_id' => $book->id,
                'borrowed_at' => $borrowedAt,
                'due_at' => $dueAt,
                'returned_at' => null,
            ])->save();


            return redirect()->route('show.my.borrowings', $userId)->with('success', 'Book\'s been added to your borrowings 📚');
        } else {
            return redirect()->route('show.my.borrowings', $userId)->with('fail', 'sorry this book is not available ❗');
        }
    }
}
