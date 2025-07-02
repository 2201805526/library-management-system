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
        @if (auth()->user()->role === 'admin' || auth()->user()->role === 'librarian')
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{route('books.create')}}" class="btn btn-outline-success">Add a new book</a>
            </li>
        </ul>
        @endif
        <br>
        @foreach ( $books as $book )
        <ul class="list-group">
            <li class="list-group-item">Title : {{$book->title}}</li>
            <li class="list-group-item">Author : {{$book->author->name}}</li>
            <li class="list-group-item">Category : {{$book->category->name}}</li>
            <li class="list-group-item"><a href="{{route('books.show', $book->id)}}"> View Details </a></li>
        </ul>
        <br>
        @endforeach
    </ul>
</div>
@endsection
