@extends('layouts.app')

@section('title', Auth::user()->name . '\'s Fines')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">{{Auth::user()->name}} Fines</h2>
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
        welcome {{ auth()->user()->name }} 👨🏼‍🎓💸
    </div>
    @section('navbar')
    @include('layouts.navbarStudent')
    @endsection


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
                <button type="submit" class="btn btn-sm btn-outline-dark px-4 text-sm float-start">Pay</button>

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
