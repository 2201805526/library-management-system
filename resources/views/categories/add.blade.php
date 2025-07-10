@extends('layouts.app')

@section('title', 'New Category')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Add new Category</h2>

        @section('navbar')
        @include('layouts.navbarLibrarian')
        @endsection
        
    @if (session('fail'))
    <div class="alert alert-dark">
        {{ session('fail') }}
    </div>
    @elseif (session('success'))
    <div class="alert alert-dark">
        {{ session('success') }}
    </div>
    @endif

        <form action="{{route('categories.store')}}" method="POST">
        @csrf

        {{-- name --}}
        <div class="mb-2">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" required class="form-control">
        </div>

        {{-- description --}}
        <div class="mb-2">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="2"></textarea>
        </div>

        {{-- submit button --}}
        <div class="text-start">
            <button type="submit" class="btn btn-outline-dark">Add Category</button>
        </div>

        </form>
    </div>
@endsection
