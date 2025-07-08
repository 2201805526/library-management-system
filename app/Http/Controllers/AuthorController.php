<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        $books = Book::with('author')->get();

        return view('authors.index', compact('authors', 'books'));
    }

    public function show(String $id)
    {
        $author = Author::findOrFail($id);
        $books = Book::where('author_id', $id)->get();

        return view('authors.details', compact('author', 'books'));
    }

    public function edit(String $id)
    {
        $author = Author::findOrFail($id);
        $books = Book::where('author_id', $id)->get();

        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, String $id)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'bio' => 'nullable|string|max:1000',
        ]);

        // to find the author
        $author = Author::findOrFail($id);
        $author->update($validated);

        return redirect()->route('authors.index')->with('success', 'Author\'s been updated successfully 🔃');
    }

    public function destroy(String $id)
    {

        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Author\'s been deleted successfully ❕');
    }

    public function create()
    {

        return view('authors.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'bio' => 'nullable|string|max:1000',
        ]);

        Author::create([
            'name' => $validated['name'],
            'bio' => $validated['bio'],
        ]);

        return redirect()->route('authors.index')->with('success', 'Author\'s been added successfully ✒');
    }
}
