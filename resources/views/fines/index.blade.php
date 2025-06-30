@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">لوحة عرض الغرامات</h2>
    <div class="alert alert-success">
        مرحباً {{ auth()->user()->name }}! يمكنك عرض الكتب والاستعارات.
    </div>

    <ul class="list-group">
        @foreach ($fines as $fine)
        <br>
        <ul class="list-group">
            <li class="list-group-item">Fine's ID : {{$fine->id}}</li>
            <li class="list-group-item">Fine's amount :{{$fine->amount}}</li>
            <li class="list-group-item">Book's title :{{$fine->borrowing->book->title}}</li>
        </ul>
        <br>
        @endforeach
    </ul>
</div>

@endsection
