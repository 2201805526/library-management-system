@extends('layouts.app')

@section('title', $author->name . '\'s Details')

@section('content')

<div class="container mt-4">
    <h2 class="mb-3">Author's Details</h2>

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

    <div >
    <p><strong>ID : </strong> {{ $author->id }}</p>
    <p><strong>Name : </strong> {{ $author->name }}</p>
    <p> <strong> Author's Biography : </strong> {{$author->bio}}</p>
    <p><strong>Books {{$author->name}} Has written : </strong></p>
    @foreach($author->books as $book)
    @if ($author->books && $book->author_id === $author->id)
    {{-- loop var to generate number for each book --}}
    <p><strong>{{$loop->iteration}})</strong>    {{ $book->title }}.</p>
    @endif
    @endforeach
    <br>
    @auth
        {{-- a librarian can either edit or delete this Author here 👇🏼 --}}
        @if (Auth::user()->role === 'librarian')
        {{-- edit  --}}
        <form action="{{route('authors.edit', $author->id)}}" method="GET" style="display:inline-block">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-warning">Edit {{$author->name}}</button>
        </form>

        {{-- delete --}}
        <form action="{{route('authors.destroy', $author->id)}}" method="POST" style="display:inline-block" onsubmit="return confirm('Return {{$author->name}}?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete {{$author->name}}</button>
        </form>
        @endif
    @endauth

    </div>

@endsection
