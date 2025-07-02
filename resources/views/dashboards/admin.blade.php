@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">لوحة تحكم المدير</h2>
    <div class="alert alert-info">
        مرحباً {{ auth()->user()->name }}! يمكنك إدارة النظام بشكل كامل.
    </div>

    <ul class="list-group">
        <li class="list-group-item"><a href="{{route('books.index')}}">إدارة الكتب</a></li>
        <li class="list-group-item"><a href="{{route('users.index')}}">إدارة المستخدمين</a></li>
        <li class="list-group-item"><a href="{{route('fines.all')}}">تقارير الاستعارات والغرامات</a></li>
    </ul>
</div>
@endsection
