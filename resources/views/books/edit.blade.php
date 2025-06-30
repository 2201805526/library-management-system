@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Book</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Title:</label>
            <input type="text" name="title" value="{{ $book->title }}" required>
        </div>

        <div>
            <label>Language:</label>
            <select name="language" required>
                <option value="English" {{ $book->language == 'English' ? 'selected' : '' }}>English</option>
                <option value="Arabic" {{ $book->language == 'Arabic' ? 'selected' : '' }}>Arabic</option>
                <option value="French" {{ $book->language == 'French' ? 'selected' : '' }}>French</option>
            </select>
        </div>

        <div>
            <label>Publication Year:</label>
            <input type="number" name="publication_year" value="{{ $book->publication_year }}" required>
        </div>

        <div>
            <label>Available:</label>
            <select name="available" required>
                <option value="1" {{ $book->available ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$book->available ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div>
            <label>Author:</label>
            <select name="author_id" required>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Category:</label>
            <select name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Update Book</button>
    </form>
</div>  

@endsection
