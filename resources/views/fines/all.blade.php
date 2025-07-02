@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">لوحة عرض الغرامات</h2>
    <div class="alert alert-success">
        مرحباً {{ auth()->user()->name }}! يمكنك عرض الكتب والاستعارات.
    </div>

    <ul class="list-group">
        @foreach ($allFines as $Fines)
        <br>
        <ul class="list-group">
            <li class="list-group-item">Fine's ID : {{$Fines->id}}</li>
            <li class="list-group-item">Student's name : {{$Fines->borrowing->user->name}}</li>
            <li class="list-group-item">Fine's amount :{{$Fines->amount}}</li>
            <li class="list-group-item">Book's title :{{$Fines->borrowing->book->title}}</li>
        </ul>
        <br>
        @endforeach
    </ul>
</div>

@endsection
