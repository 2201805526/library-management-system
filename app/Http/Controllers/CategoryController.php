<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Auth\Events\Validated;
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

        return view('categories.details', compact('category', 'books'));
    }
    public function edit(String $id) {
        $category = Category::findOrFail($id);
        $books = Book::where('category_id', $id)->get();

        return view('categories.edit', compact('category', 'books'));
    }
    public function update(Request $request, String $id){
        $validated = $request->validate([
            'name'=> 'required|string|max:200',
            'description'=> 'nullable|string|max:1000',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category\'s been updated successfully 🔃');
    }
    public function destroy(String $id) {

        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category\'s been deleted successfully ❕');
    }
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
