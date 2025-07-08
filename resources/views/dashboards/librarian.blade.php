@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Librarian Dashboard </h2>
    <div class="alert alert-dark">
        welcome {{ auth()->user()->name }} 📚
    </div>

    <ul class="list-group">
        <li class="list-group-item"><a class="link-dark" href="{{ route('books.index') }}">Books </a></li>
        <li class="list-group-item"><a class="link-dark" href="{{route('authors.index')}}">Authors</a></li>
        <li class="list-group-item"><a class="link-dark" href="{{route('categories.index')}}">Categories </a></li>
        <li class="list-group-item"><a class="link-dark" href="{{route('show.all.borrowings')}}">Borrowings </a></li>
        <li class="list-group-item"><a class="link-dark" href="{{route('borrowings.history')}}"> Borrowing's History  </a></li>
        <li class="list-group-item"><a class="link-dark" href="{{route('fines.all')}}">Fines </a></li>
    </ul>
</div>
@endsection
