@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Book</h1>

    <form action="{{route('books.store')}}" method="POST">
        @csrf

        <div>
            <label>Title: </label>
            <input type="text" name="title" required>
        </div>

        <div>
            <label>Language: </label>
            <select name="language" required>
                <option value="English">English</option>
                <option value="Arabic">Arabic</option>
                <option value="French">French</option>
            </select>
        </div>

        <div>
            <label>Publication Year: </label>
            <input type="number" name="publication_year" required>
        </div>

        <div>
            <label>Available: </label>
            <select name="available" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <div>
            <label>Author: </label>
            <select name="author_id" required>
                @foreach($authors as $author)
                    <option value="{{$author->id}}">{{$author->name}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Category: </label>
            <select name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Add Book</button>
    </form>
</div>

@endsection
