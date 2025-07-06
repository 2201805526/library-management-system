
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('users.update', $user->id)}}" method="POST">
        @csrf
        @method('PUT')

       {{-- Name --}}
       <div class="mb-3">
        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    {{-- Email --}}
    <div class="mb-3">
        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    {{-- role --}}
    <div class="mb-3">
        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
        <select name="role" id="role" class="form-select" required>
            <option value="">Select Role</option>
            @foreach (['admin', 'librarian', 'student'] as $role)
                <option
                    value="{{ $role }}"
                    {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                    {{ ucfirst($role) }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- password --}}
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
    </div>

    {{-- confirmation field --}}
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>

    {{-- email verified at (display only) --}}
    <div class="mb-3">
        <label class="form-label">Email Verified At</label>
        <input type="text" class="form-control" value="{{ $user->email_verified_at ?? 'Not verified' }}" readonly>
    </div>

    {{-- submit --}}
    <div class="text-start">
        <button type="submit" class="btn btn-outline-warning">
            Update {{$user->name}}
        </button>
    </div>
    </form>
</div>
@endsection
