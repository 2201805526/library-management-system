<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        $books = Book::with('category')->get();

        return view('categories.index', compact('categories', 'books'));
    }
    public function show(String $id) {
        $category = Category::findOrFail($id);
        $books = Book::where('category_id', $id)->get();

        return view('categories.show', compact('category', 'books'));
    }
    public function edit(String $id) {}
    public function update(Request $request, String $id){}
    public function destroy() {}
    public function create() {

        return view('categories.create');
    }
    public function store(Request $request) {

        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'description'=> 'nullable|string|max:1000',
        ]);

        Category::create([
            'name'=>$validated['name'],
            'description'=>$validated['description'],
        ]);

        return redirect()->route('categories.index')->with('success', 'Category\'s been added successfully 💯');
    }
}
