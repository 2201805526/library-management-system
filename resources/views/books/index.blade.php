@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">لوحة عرض الكتب</h2>
    <div class="alert alert-success">
        مرحباً {{ auth()->user()->name }}! يمكنك عرض الكتب والاستعارات.
    </div>

    <ul class="list-group">
        @foreach ($books as $book )
        <ul class="list-group">
            <li class="list-group-item">{{$book}}</li>
        </ul>

        @endforeach
    </ul>
</div>
@endsection
