@extends('layouts.app')

@section('title', Auth::user()->name . '\'s Borrowings')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">My Borrowings </h2>

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
        welcome {{ auth()->user()->name }} 👨🏼‍🎓
    </div>


    <ul class="list-group">
        @if (!is_null($borrowings))
        @foreach ($borrowings as $borrowing)
      @if ($borrowing->user_id === Auth::user()->id)
            @if(is_null($borrowing->returned_at))
                <li class="list-group-item"><strong> Student's name : </strong> {{$borrowing->user->name}}</li>
                <li class="list-group-item"><strong>Book's Title :</strong> {{$borrowing->book->title}}</li>
                <li class="list-group-item"><strong>Borrowed at :</strong> {{$borrowing->borrowed_at}}</li>
                <li class="list-group-item"><strong>Due at :</strong> {{$borrowing->due_at}}</li>
                <li class="list-group-item">
                <form class="float" action="{{route('borrowing.return',  $borrowing->id)}}" method="POST" onsubmit="return confirm('Return {{$borrowing->book->title}}?')">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-sm btn-outline-dark px-4 text-sm float-start">Return the Book</button>
                </form>
                </li>
                <br>
            @endif
        @endif
        @endforeach
        @endif
    </ul>
</div>

@endsection
