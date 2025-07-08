@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Author</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('authors.update', $author->id)}}" method="POST">
        @csrf
        @method('PUT')

       {{-- name --}}
       <div class="mb-3">
        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $author->name) }}" required>
    </div>

    {{-- Bio --}}
    <div class="mb-3">
        <label for="bio" class="form-label">Bio </label>
        <textarea name="bio" id="bio" class="form-control" rows="2">{{$author->bio}}</textarea>
    </div>

    {{-- submit --}}
    <div class="text-start">
        <button type="submit" class="btn btn-outline-warning">
            Update {{$author->name}}
        </button>
    </div>
    </form>
</div>

@endsection
