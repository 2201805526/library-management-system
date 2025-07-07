@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">لوحة تحكم المدير</h2>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="alert alert-dark">
        مرحباً {{ auth()->user()->name }}! يمكنك إدارة المستخدمين بشكل كامل.
    </div>

    <ul class="list-group">
        @foreach ( $users as $user )
            <li class="list-group-item"><strong>ID : </strong>{{$user->id}}</li>
            <li class="list-group-item"><strong>Name : </strong>{{$user->name}}</li>
            <li class="list-group-item"><strong>Role : </strong>{{$user->role}}</li>

            @if ($user->role === 'student' || $user->role === 'librarian')
            <li class="list-group-item"><button class="btn btn-sm btn-outline-info" onclick="window.location='{{route('users.show', $user)}}'">Show {{$user->name}}'s Details </button></li>
            @endif
            <br>
        @endforeach

    </ul>
</div>
@endsection
