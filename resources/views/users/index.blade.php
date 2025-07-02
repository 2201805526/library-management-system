@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">لوحة تحكم المدير</h2>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="alert alert-info">
        مرحباً {{ auth()->user()->name }}! يمكنك إدارة المستخدمين بشكل كامل.
    </div>

    <ul class="list-group">
        @foreach ( $users as $user )
            <li class="list-group-item">{{$user->id}}</li>
            <li class="list-group-item">{{$user->name}}</li>
            <li class="list-group-item">{{$user->role}}</li>

            @if ($user->role === 'student' || $user->role === 'librarian')
            <li class="list-group-item"><button class="btn btn-info" onclick="window.location='{{route('users.show', $user)}}'"> {{$user->name}}'s Details </button></li>
            @endif
            <br>
        @endforeach

    </ul>
</div>
@endsection
