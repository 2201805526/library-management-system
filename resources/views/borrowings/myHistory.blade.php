@extends('layouts.app')

@section('title', Auth::user()->name . '\'s Borrowings\' History')


@section('content')
<div class="container mt-4">
    <h2 class="mb-3">My Borrowings' History</h2>

    @section('navbar')
    @include('layouts.navbarStudent')
    @endsection

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
    @foreach ($borrowings as $borrowing)
      <ul class="list-group">
            @if(!is_null($borrowing->returned_at))
            <li class="list-group-item"><strong>Book's Title :</strong>  {{$borrowing->book->title}}</li>
            <li class="list-group-item"><strong>Borrowed at :</strong>  {{$borrowing->borrowed_at}}</li>
            <li class="list-group-item"><strong>Due at :</strong> {{$borrowing->due_at}}</li>
            <li class="list-group-item"><strong>This borrowing was returned at :</strong>  {{$borrowing->returned_at}}</li>
            @endif
            <br>
        </ul>
    @endforeach
</div>

@endsection
