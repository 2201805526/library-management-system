@extends('layouts.app')

@section('title', 'Student\'s Dashboard')

@php
    $userID = auth()->user()->id;
@endphp

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Student's Dashboard </h2>
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
        welcome {{ auth()->user()->name }} 👨🏼‍🎓❕
    </div>
    @section('navbar')
    @include('layouts.navbarStudent')
    @endsection

    <ul class="list-group">
        <li class="list-group-item"><a class="link-dark text-decoration-none" href="{{route('books.index')}}">Books </a></li>
        <li class="list-group-item"><a class="link-dark text-decoration-none" href="{{route('authors.index')}}">Authors</a></li>
        <li class="list-group-item"><a class="link-dark text-decoration-none" href="{{route('categories.index')}}">Categories</a></li>
        <li class="list-group-item"><a class="link-dark text-decoration-none" href="{{route('show.my.borrowings', $userID)}}">My Borrowings </a></li>
        <li class="list-group-item"><a class="link-dark text-decoration-none" href="{{route('show.my.history',$userID)}}">Borrowings' History</a></li>
        <li class="list-group-item"><a class="link-dark text-decoration-none" href="{{route('fines.index')}}">My Fines</a></li>
    </ul>
    <br>
</div>
@endsection
