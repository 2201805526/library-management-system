@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add New Author</h1>

    {{-- validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('authors.store')}}" method="POST">
        @csrf

        {{-- name --}}
        <div class="mb-2">
            <label for="name" class="form-label">Name </label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        {{-- bio --}}
        <div class="mb-2">
            <label for="bio" class="form-label">Biography </label>
            <textarea required name="bio" id="bio" rows="2" class="form-control"></textarea>
        </div>

        {{-- submit button --}}
        <div class="text-start ">
            <button type="submit" class="btn btn-outline-dark">
                Add Author
            </button>
        </div>
    </form>
</div>

@endsection
