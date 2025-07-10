@extends('layouts.app')

@section('title', 'Borrowings History')

@section('content')

<div class="container mt-4">
    <h2 class="mb-3"> Borrowings History</h2>

    @auth
    @section('navbar')
        @if (auth()->user()->role === 'admin')
         @include('layouts.navbarAdmin')
        @elseif (auth()->user()->role === 'librarian')
         @include('layouts.navbarLibrarian')
         @endif
    @endsection
    @endauth
    
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
        welcome {{ auth()->user()->name }} ❕
    </div>

    <ul class="list-group">
      @foreach ($borrowings as $borrowing)
      @if ($borrowing->book->available  && !is_null($borrowing->returned_at))
        <ul class="list-group">
          <li class="list-group-item">Borrowing id : {{$borrowing->id}}</li>
          <li class="list-group-item">user id : {{$borrowing->user->name}}</li>
          <li class="list-group-item">Book's Title : {{$borrowing->book->title}}</li>
          <li class="list-group-item">Borrowed at : {{$borrowing->borrowed_at}}</li>
          <li class="list-group-item">Returned at : {{$borrowing->returned_at}}</li>
         <br>
        </ul>
      @endif
        @endforeach
    </ul>
</div>
@endsection
