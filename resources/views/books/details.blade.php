@extends('layouts.app')

@section('title', $book->title . ' Details')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Book Details</h2>

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

    <p><strong>Title:</strong> {{ $book->title }}</p>
    <p><strong>Language:</strong> {{ $book->language }}</p>
    <p><strong>Publication Year:</strong> {{ $book->publication_year }}</p>
    <p><strong>Description:</strong> {{ $book->description }}</p>
    <p><strong>Available:</strong> {{ $book->available ? 'Yes' : 'No' }}</p>
    <p><strong>Author:</strong> {{ $book->author->name }}</p>
    <p><strong>Category:</strong> {{ $book->category->name }}</p>
    <br>
    @auth
        {{-- an admin or librarian can either edit or delete this book here 👇🏼 --}}
        @if (Auth::user()->role === 'librarian')
        {{-- edit  --}}
        <form style="display: inline-flex" action="{{route('books.edit', $book->id)}}" method="GET">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-warning">Edit {{$book->title}}</button>
        </form>

        {{-- delete --}}
        <form style="display: inline-flex" action="{{route('books.destroy', $book->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete {{$book->title}}</button>
        </form>
        {{--
            a student can borrow this book here,
            when the book's available 👇🏼
         --}}
        @elseif (Auth::user()->role === 'student' && $book->available)
        <form action="{{route('borrow.book', $book->id)}}" method="POST" onsubmit="return confirm('Borrow {{$book->title}}?')">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-dark">Borrow {{$book->title}}</button>
        </form>
        {{--
            if the book wasn't available,
            because the current user has borrowed it.
            he can return it here 👇🏼
          --}}
        @elseif(
          Auth::user()->role === 'student' &&
         !$book->available &&
          $book->currentBorrowing &&
          $book->currentBorrowing->user->id === Auth::user()->id
          )
        <form action="{{route('books.return',  $book->id)}}" method="POST" onsubmit="return confirm('Return {{$book->title}}?')">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-dark px-4 float-start">Return the Book</button>
        </form>
        @endif
    @endauth
</div>

@endsection
