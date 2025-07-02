<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Cast\String_;

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

        return view('books.details', [
            'book' => Book::findOrFail($id)
        ]);
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
}
