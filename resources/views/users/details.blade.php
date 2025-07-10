@extends('layouts.app')

@section('title', $user->name . '\'s Details')

@section('content')

@auth
@if (auth()->user()->role === 'admin')
@section('navbar')
@include('layouts.navbarAdmin')
@endsection
@endif
@endauth

<div class="container mt-4">
    <h2 class="mb-3">User's Details</h2>
    <ul class="lis-group">

        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>
        <p><strong>Created at:</strong> {{ $user->created_at }}</p>

                <a href="{{route('users.edit', $user->id)}}" style="display:inline-block;" class="btn btn-sm btn-outline-warning">Edit</a>

                <form action="{{route('users.destroy', $user->id)}}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete {{$user->name}}\'s profile?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
    </ul>


</div>

@endsection
