@extends('layouts.app')

@section('title', 'All Fines')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">All Fines </h2>
    @if (session('fail'))
    <div class="alert alert-dark">
        {{ session('fail') }}
    </div>
    @elseif (session('success'))
    <div class="alert alert-dark">
        {{ session('success') }}
    </div>
    @endif
    @auth
    @section('navbar')
    @if (auth()->user()->role === 'admin')
    @include('layouts.navbarAdmin')
    @elseif (auth()->user()->role === 'librarian')
    @include('layouts.navbarLibrarian')
    @endif
    @endsection
    @endauth

    <div class="alert alert-dark">
        welcome {{ auth()->user()->name }} 💸
    </div>

    <ul class="list-group">
        @foreach ($allFines as $Fines)
        <br>
        <ul class="list-group">
            {{-- @if ($Fines->paid)
            <li class="list-group-item text-start"> <span class="badge bg-success"> Paid </span></li>
            @elseif (!$Fines->paid)
            <li class="list-group-item text-start"> <span class="badge bg-danger"> Not Paid </span></li>
            @endif --}}
            <li class="list-group-item">Fine's ID : {{$Fines->id}}</li>
            <li class="list-group-item">Student : {{$Fines->borrowing->user->name}}</li>
            <li class="list-group-item">Fine's amount : <span class="text-success"><strong>{{$Fines->amount}}$</strong></span></li>
            <li class="list-group-item space-between">Borrowing was due at : {{$Fines->borrowing->due_at}}
            @if ($Fines->paid) <span class="badge bg-success "> Paid </span>
            @elseif (!$Fines->paid)  <span class="badge bg-danger"> Not Paid </span> @endif</li>
            <li class="list-group-item">Book's title : {{$Fines->borrowing->book->title}}</li>
        </ul>
        <br>
        @endforeach
    </ul>
</div>

@endsection
