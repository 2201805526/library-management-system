@extends('layouts.app')

@section('title', 'Books')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">All Books </h2>
    @if (session('fail'))
    <div class="alert alert-dark">
        {{ session('fail') }}
    </div>
    @elseif (session('success'))
    <div class="alert alert-dark">
        {{ session('success') }}
    </div>
    @endif
    <div class="alert alert-dark">
        welcome {{ auth()->user()->name }} 📚
    </div>

    @auth
    @section('navbar')
        @if (auth()->user()->role === 'admin')
         @include('layouts.navbarAdmin')
        @elseif (auth()->user()->role === 'librarian')
         @include('layouts.navbarLibrarian')
        @elseif (auth()->user()->role === 'student')
         @include('layouts.navbarStudent')
        @endif
    @endsection
    @endauth

    <ul class="list-group">
        @if (auth()->user()->role === 'admin' || auth()->user()->role === 'librarian')
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ route('books.create') }}" class="btn btn-sm btn-outline-dark">
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
            <li class="list-group-item"><a href="{{route('books.show', $book->id)}}" class="btn btn-sm btn-outline-secondary"> View {{$book->title}}'s Details </a></li>
        </ul>
        <br>
        @endforeach
    </ul>
</div>
@endsection
