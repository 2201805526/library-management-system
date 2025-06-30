@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">لوحة تحكم الطالب</h2>
    <div class="alert alert-primary">
        مرحباً {{ auth()->user()->name }}! يمكنك تصفح الكتب ومتابعة استعاراتك.
    </div>
    <br>
    <ul class="list-group">
        <li class="list-group-item"><a href="{{route('books.index')}}">تصفح الكتب</a></li>
        <li class="list-group-item"><a href="{{route('borrowings.index')}}">كتبي المستعارة</a></li>
        <li class="list-group-item"><a href="{{route('fines.index')}}">غراماتي</a></li>
    </ul>
    <br>
</div>
@endsection
