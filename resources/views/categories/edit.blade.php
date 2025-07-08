@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Category</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('categories.update', $category->id)}}" method="POST">
        @csrf
        @method('PUT')

       {{-- name --}}
       <div class="mb-3">
        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
    </div>

    {{-- description --}}
    <div class="mb-3">
        <label for="description" class="form-label">Bio </label>
        <textarea name="description" id="description" class="form-control" rows="2">{{$category->description}}</textarea>
    </div>

    {{-- submit --}}
    <div class="text-start">
        <button type="submit" class="btn btn-outline-warning">
            Update {{$category->name}}
        </button>
    </div>
    </form>
</div>

@endsection
