@extends('layouts.app')
@php
    $userID = auth()->user()->id;
@endphp

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Student's Dashboard  </h2>
    <div class="alert alert-dark">
        welcome {{ auth()->user()->name }} 👨🏼‍🎓❕
    </div>
    <br>
    <ul class="list-group">
        <li class="list-group-item"><a class="link-dark" href="{{route('books.index')}}">Books </a></li>
        <li class="list-group-item"><a class="link-dark" href="{{route('authors.index')}}">Authors</a></li>
        <li class="list-group-item"><a class="link-dark" href="{{route('categories.index')}}">Categories</a></li>
        <li class="list-group-item"><a class="link-dark" href="{{route('show.my.borrowings', $userID)}}">My Borrowings </a></li>
        <li class="list-group-item"><a class="link-dark" href="{{route('show.my.history',$userID)}}">Borrowings' History</a></li>
        <li class="list-group-item"><a class="link-dark" href="{{route('fines.index')}}">My Fines</a></li>
    </ul>
    <br>
</div>
@endsection
