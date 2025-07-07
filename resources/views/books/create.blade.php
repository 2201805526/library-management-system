@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add New Book</h1>

    {{-- Show validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('books.store')}}" method="POST">
        @csrf

        {{-- title --}}
        <div class="mb-2">
            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        {{-- language --}}
        <div class="mb-2">
            <label for="language" class="form-label">Language<span class="text-danger">*</span> </label>
            <select name="language" id="language" class="form-select" required>
                <option value="English">English</option>
                <option value="Arabic">Arabic</option>
                <option value="French">French</option>
            </select>
        </div>

        {{-- publication_year --}}
        <div class="mb-2">
            <label for="publication_year" class="form-label">Publication Year</label>
            <input required type="number" name="publication_year" id="publication_year" class="form-control" value="2000">
        </div>

        {{-- description --}}
        <div class="mb-2">
            <label for="description" class="form-label">Description</label>
            <textarea required name="description" id="description" rows="2" class="form-control"></textarea>
        </div>

        {{-- author --}}
        <div class="mb-2">
            <label for="author_id" class="form-label">Author <span class="text-danger">*</span></label>
            <select name="author_id" id="author_id" class="form-select" required>
                @foreach($authors as $author)
                    <option value="{{$author->id}}">{{$author->name}}</option>
                @endforeach
            </select>
        </div>

        {{-- category --}}
        <div class="mb-2">
            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
            <select name="category_id" id="category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- submit button --}}
        <div class="text-start ">
            <button type="submit" class="btn btn-outline-success">
                Add Book
            </button>
        </div>
    </form>
</div>

@endsection
