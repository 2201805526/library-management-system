@extends('layouts.app')

@section('title', 'Borrowings')

@section('content')

<div class="container mt-4">
    <h2 class="mb-3"> Active Borrowings </h2>
    @if (session('fail'))
    <div class="alert alert-dark">
        {{ session('fail') }}
    </div>
    @elseif (session('success'))
    <div class="alert alert-dark">
        {{ session('success') }}
    </div>
    @endif
    @section('navbar')
    @include('layouts.navbarLibrarian')
    @endsection
    <div class="alert alert-dark">
        Current Borrowings {{ auth()->user()->name }} ❕
    </div>

    <ul class="list-group">
      @foreach ($borrowings as $borrowing)
      @if (!$borrowing->book->available  && is_null($borrowing->returned_at))

        <ul class="list-group">
          <li class="list-group-item">Borrowing id : {{$borrowing->id}}</li>
          <li class="list-group-item">user id : {{$borrowing->user_id}}</li>
          <li class="list-group-item">Book's Title : {{$borrowing->book->title}}</li>
          <li class="list-group-item">Borrowed at : {{$borrowing->borrowed_at}}</li>
          <li class="list-group-item">Due at : {{$borrowing->due_at}}</li>
         <br>
        </ul>
      @endif
        @endforeach
    </ul>
</div>
@endsection
