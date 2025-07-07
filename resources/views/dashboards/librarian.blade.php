@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">لوحة تحكم أمين المكتبة</h2>
    <div class="alert alert-success">
        مرحباً {{ auth()->user()->name }}! يمكنك إدارة الكتب والاستعارات.
    </div>

    <ul class="list-group">
        <li class="list-group-item"><a href="{{ route('books.index') }}">إدارة الكتب</a></li>
        <li class="list-group-item"><a href="{{route('authors.index')}}">Authors</a></li>
        <li class="list-group-item"><a href="{{route('categories.index')}}">Categories </a></li>
        <li class="list-group-item"><a href="{{route('show.all.borrowings')}}">استعراض الاستعارات</a></li>
        <li class="list-group-item"><a href="{{route('borrowings.history')}}"> استعراض الاستعارات القديمة</a></li>
        <li class="list-group-item"><a href="{{route('fines.all')}}">متابعة الغرامات</a></li>
    </ul>
</div>
@endsection
