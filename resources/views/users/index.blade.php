@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">لوحة تحكم المدير</h2>
    <div class="alert alert-info">
        مرحباً {{ auth()->user()->name }}! يمكنك إدارة المستخدمين بشكل كامل.
    </div>

    <ul class="list-group">
        @foreach ($users as $user )
        <ul class="list-group">
            <li class="list-group-item">{{$user}}</li>
        </ul>
        @endforeach

    </ul>
</div>
@endsection
