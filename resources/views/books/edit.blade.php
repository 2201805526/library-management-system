@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Book</h1>

    <form action="{{route('books.update', $book->id)}}" method="POST">
        @csrf
        @method('PUT')

        {{-- title --}}
        <div class="mb-2">
            <label for="title" class="form-label">Title:</label>
            <input type="text" name="title" id="title" class="form-control"  value="{{ $book->title }}" required>
        </div>

        {{-- language --}}
        <div class="mb-2">
            <label for="language" class="form-label">Language:</label>
            <select name="language" id="language" class="form-select" required>
                <option value="English" {{ $book->language == 'English' ? 'selected' : '' }}>English</option>
                <option value="Arabic" {{ $book->language == 'Arabic' ? 'selected' : '' }}>Arabic</option>
                <option value="French" {{ $book->language == 'French' ? 'selected' : '' }}>French</option>
            </select>
        </div>

        {{-- publication year --}}
        <div class="mb-2">
            <label for="publication_year" class="form-label">Publication Year:</label>
            <input type="number" name="publication_year" class="form-control" value="{{ $book->publication_year }}" required>
        </div>

        {{-- description --}}
        <div class="mb-2">
            <label class="form-label" for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="2">{{old($book->description)}}</textarea>
        </div>

        {{-- availability --}}
        <div class="mb-2">
            <label for="available" class="form-label">Available:</label>
            <select name="available" id="available" class="form-select" required>
                <option value="1" {{ $book->available ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$book->available ? 'selected' : '' }}>No</option>
            </select>
        </div>

        {{-- author's name --}}
        <div class="mb-2">
            <label for="author_id" class="form-label">Author:</label>
            <select name="author_id" id="author_id" class="form-select" required>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- category's name --}}
        <div class="mb-2">
            <label class="form-label">Category:</label>
            <select class="form-control" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- submit --}}
    <div class="text-start mb-5">
        <button type="submit" class="btn btn-outline-warning">
            Update {{$book->title}}
        </button>
    </div>
    </form>
</div>

@endsection
