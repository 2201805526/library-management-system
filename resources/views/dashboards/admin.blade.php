@extends('layouts.app')

@section('title', 'Admin\'s dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Admin's Dashboard</h2>
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
        welcome {{ auth()->user()->name }} 💻❕
    </div>
    @section('navbar')
    @include('layouts.navbarAdmin')
    @endsection

    <ul class="list-group">
     <li class="list-group-item"><a class="link-dark text-decoration-none" href="{{route('books.index')}}">Books</a></li>
     <li class="list-group-item"><a class="link-dark text-decoration-none" href="{{route('authors.index')}}">Authors</a></li>
     <li class="list-group-item"><a class="link-dark text-decoration-none" href="{{route('categories.index')}}">Categories</a></li>
     <li class="list-group-item"><a class="link-dark text-decoration-none" href="{{route('users.index')}}">Users</a></li>
     <li class="list-group-item"><a class="link-dark text-decoration-none" href="{{route('borrowings.history')}}"> Borrowing's History  </a></li>
     <li class="list-group-item"><a class="link-dark text-decoration-none" href="{{route('fines.all')}}">Fines  </a></li>
    </ul>
</div>
@endsection
