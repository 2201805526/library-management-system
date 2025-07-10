@extends('layouts.app')

@section('title', 'Authors')

@section('content')

<div class="container mt-4">
    <h2 class="mb-3"> All Authors </h2>
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
    <div class="alert alert-dark">
        {{ auth()->user()->name }} ✒
    </div>

    <ul class="list-group">
        @if (auth()->user()->role === 'librarian')
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ route('authors.create') }}" class="btn btn-sm btn-outline-dark">
                    Add New Author    {{-- you can add a new author from here  --}}
                </a>
            </li>
        </ul>
        <br>
        @endif
      @foreach ($authors as $author)
        <ul class="list-group">
            @auth
                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'librarian')
                <li class="list-group-item"><strong>Author ID : </strong>{{$author->id}}</li>
                @endif
            @endauth
          <li class="list-group-item"> <strong>Author's name : </strong> {{$author->name}}</li>
                <li class="list-group-item">
                <a href="{{route('authors.show', $author->id)}}" class="btn btn-sm btn-outline-secondary">Show {{$author->name}}'s info </a>
                </li>
         <br>
        </ul>
        @endforeach
    </ul>
</div>

@endsection
