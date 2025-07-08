@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">My Borrowings </h2>
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
      @foreach ($borrowings as $borrowing)
      @if ($borrowing->user_id === Auth::user()->id)

      <ul class="list-group">
            @if(is_null($borrowing->returned_at))
                <li class="list-group-item">user id : {{$borrowing->user_id}}</li>
                <li class="list-group-item">Student's name : {{$borrowing->user->name}}</li>
                <li class="list-group-item">Book's Title : {{$borrowing->book->title}}</li>
                <li class="list-group-item">Borrowed at : {{$borrowing->borrowed_at}}</li>
                <li class="list-group-item">Due at : {{$borrowing->due_at}}</li>
                <li class="list-group-item">
                <form class="float" action="{{route('borrowing.return',  $borrowing->id)}}" method="POST" onsubmit="return confirm('Return {{$borrowing->book->title}}?')">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-sm btn-outline-dark px-4 text-sm float-start">Return the Book</button>
                </form>
                </li>
            @endif
            <br>
        </ul>
        @endif
        @endforeach
    </ul>
</div>

@endsection
