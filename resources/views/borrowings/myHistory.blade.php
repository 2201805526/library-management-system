@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">لوحة عرض الاستعارات</h2>
    @if (session('fail'))
    <div class="alert alert-danger">
        {{ session('fail') }}
    </div>
    @elseif (session('success'))
    <div class="alert alert-light">
        {{ session('success') }}
    </div>
    @endif
    <div class="alert alert-success">
        مرحباً {{ auth()->user()->name }}! يمكنك عرض الاستعارات.
    </div>
    @foreach ($borrowings as $borrowing)
      <ul class="list-group">
            @if(!is_null($borrowing->returned_at))
            <li class="list-group-item">user id : {{$borrowing->user_id}}</li>
            <li class="list-group-item">Student's name : {{$borrowing->user->name}}</li>
            <li class="list-group-item">Book's Title : {{$borrowing->book->title}}</li>
            <li class="list-group-item">Borrowed at : {{$borrowing->borrowed_at}}</li>
            <li class="list-group-item">Due at : {{$borrowing->due_at}}</li>
            <li class="list-group-item">This borrowing was returned at : {{$borrowing->returned_at}}</li>
            @endif
            <br>
        </ul>
    @endforeach
</div>

@endsection
