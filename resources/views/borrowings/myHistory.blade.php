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
