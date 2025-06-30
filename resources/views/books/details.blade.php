@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Book Details</h1>

    <p><strong>Title:</strong> {{ $book->title }}</p>
    <p><strong>Language:</strong> {{ $book->language }}</p>
    <p><strong>Publication Year:</strong> {{ $book->publication_year }}</p>
    <p><strong>Available:</strong> {{ $book->available ? 'Yes' : 'No' }}</p>
    <p><strong>Author:</strong> {{ $book->author->name }}</p>
    <p><strong>Category:</strong> {{ $book->category->name }}</p>

    <a href="{{ route('books.edit', $book->id) }}">Edit Book</a>
</div>

@endsection
