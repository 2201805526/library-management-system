@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">لوحة عرض الكتب </h2>
    @if (session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif
    <div class="alert alert-success text-center">
        مرحباً {{ auth()->user()->name }}! يمكنك عرض الكتب والاستعارات.
    </div>

    <ul class="list-group text-center">
        @if (auth()->user()->role === 'librarian')
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ route('books.create') }}" class="btn btn-sm btn-outline-success">
                    Add New Book
                </a>
            </li>
        </ul>
        @endif
        <br>
        @foreach ($books as $book)
        <ul class="list-group">
            <li class="list-group-item">Title : {{$book->title}}</li>
            <li class="list-group-item">Author : {{$book->author->name}}</li>
            <li class="list-group-item">Category : {{$book->category->name}}</li>
            <li class="list-group-item"><a href="{{route('books.show', $book->id)}}" class="btn btn-sm btn-outline-info"> View {{$book->title}}'s Details </a></li>
        </ul>
        <br>
        @endforeach
    </ul>
</div>
@endsection
