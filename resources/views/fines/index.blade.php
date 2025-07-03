@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">لوحة عرض الغرامات</h2>
    @if (session('success'))
    <div class="alert alert-info">
        {{ session('success') }}
    </div>
@endif
    <div class="alert alert-success">
        مرحباً {{ auth()->user()->name }}! يمكنك عرض الكتب والاستعارات.
    </div>

    <ul class="list-group">
        @foreach ($fines as $fine)
        <br>
        <ul class="list-group">
            <li class="list-group-item">Fine's ID : {{$fine->id}}</li>
            <li class="list-group-item">Book's title : {{$fine->borrowing->book->title}}</li>
            <li class="list-group-item">Fine's amount : <strong>{{$fine->amount}}</strong>
            <form class="float" action="{{route('fines.pay', $fine->id)}}" method="post" onsubmit="return confirm('Pay {{$fine->amount}} for a fine?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-success px-4 text-sm float-start">Pay</button>

            </form>
            </li>
            <li class="list-group-item">Fine was issued at : {{$fine->issued_at}}</li>

            <li class="list-group-item"><strong>Borrowed by : <i> {{$user->name}}</strong></i></li>
        </ul>
        <br>
        @endforeach
    </ul>
</div>

@endsection
