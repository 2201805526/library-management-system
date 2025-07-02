
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>

    <form action="{{ route('users.update', $user->id)}}" method="POST">
        @csrf
        @method('PUT')

        {{-- name --}}
        <div class="form-group">
            <label>Name:</label>
            <input class="form-control" type="text" name="name" value="{{ $user->name }}" required>
        </div> <br>

        {{-- email --}}
        <div class="form-group">
            <label>Email:</label>
            <input class="form-control" type="email" name="email" value="{{ $user->email }}" required>
        </div> <br>


        {{-- password --}}
        <div class="form-group">
            <label for="password">New Password (leave blank to keep current)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div> <br>

        {{-- role --}}
        <div class="form-group">
            <label>Role:</label>
            <select class="form-control" name="role" required>
                <option value="English" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="Arabic" {{ $user->role == 'librarian' ? 'selected' : '' }}>Librarian</option>
                <option value="French" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
            </select>
        </div> <br>

        <button class="btn btn-outline-warning" type="submit">Update {{$user->name}}'s info</button>
    </form>
</div>

@endsection
