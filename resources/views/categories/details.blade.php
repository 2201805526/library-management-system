@extends('layouts.app')

@section('title',$category->name . '\'s Details')

@section('content')

<div class="container mt-4">

    <h2 class="mb-3">Category's Details</h2>

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


    @if (Auth::user()->role === 'admin' || Auth::user()->role === 'librarian')
    <p><strong>ID : </strong> {{ $category->id }}</p>
    @endif
    <p><strong>Name : </strong> {{ $category->name }}</p>
    <p> <strong> Description : </strong> {{$category->description}}</p>
    <p><strong>Books Categorized as {{$category->name}} : </strong></p>
    @foreach($category->books as $book)
    @if ($category->books && $book->category_id === $category->id)
    {{-- loop var to generate number for each book --}}
    <p><strong>{{$loop->iteration}})</strong>    {{ $book->title }}.</p>
    @endif
    @endforeach
    <br>
    @auth
        {{-- a librarian can either edit or delete this category here 👇🏼 --}}
        @if (Auth::user()->role === 'librarian')
        {{-- edit  --}}
        <form action="{{route('categories.edit', $category->id)}}" method="GET" style="display:inline-block">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-warning">Edit {{$category->name}}</button>
        </form>

        {{-- delete --}}
        <form action="{{route('categories.destroy', $category->id)}}" method="POST" style="display:inline-block" onsubmit="return confirm('Return {{$category->name}}?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete {{$category->name}}</button>
        </form>
        @endif
    @endauth
@endsection
