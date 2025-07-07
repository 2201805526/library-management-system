@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2 class="mb-3"> All Categories </h2>
    @if (session('fail'))
    <div class="alert alert-danger">
        {{ session('fail') }}
    </div>
    @elseif (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="alert alert-dark">
        welcome {{ auth()->user()->name }} ❕
    </div>

    <ul class="list-group">
        @if (auth()->user()->role === 'librarian')
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-success">
                    Add New Category    {{-- you can add a new category  from here  --}}
                </a>
            </li>
        </ul>
        <br>
        @endif
      @foreach ($categories as $category)
        <ul class="list-group">
            @auth
                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'librarian')
                <li class="list-group-item"><strong>Category ID : </strong>{{$category->id}}</li>
                @endif
            @endauth
          <li class="list-group-item"> <strong>Category's name : </strong> {{$category->name}}</li>
                <li class="list-group-item">
                <a href="{{route('categories.show', $category->id)}}" class="btn btn-sm btn-outline-info">Show {{$category->name}}'s info </a>
                </li>
         <br>
        </ul>
        @endforeach
    </ul>
</div>
@endsection
