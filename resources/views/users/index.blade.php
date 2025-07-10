@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container mt-4">

    @auth
    @if (auth()->user()->role === 'admin')
    @section('navbar')
    @include('layouts.navbarAdmin')
    @endsection
    @endif
    @endauth

    <h2 class="mb-3">All Users</h2>

    <div class="alert alert-dark">
        welcome {{ auth()->user()->name }} 💻❕
    </div>

    <ul class="list-group">
        @foreach ( $users as $user )
            <li class="list-group-item"><strong>ID : </strong>{{$user->id}}</li>
            <li class="list-group-item"><strong>Name : </strong>{{$user->name}}</li>
            <li class="list-group-item"><strong>Role : </strong>{{$user->role}}</li>

            @if ($user->role === 'student' || $user->role === 'librarian')
            <li class="list-group-item"><button class="btn btn-sm btn-outline-secondary" onclick="window.location='{{route('users.show', $user)}}'">Show {{$user->name}}'s Details </button></li>
            @endif
            <br>
        @endforeach

    </ul>
</div>
@endsection
