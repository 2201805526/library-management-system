<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <title>@yield('title', 'Library Management System')</title>
    <!-- Bootstrap CSS from both folders for compatibility -->
    <link rel="stylesheet" href="{{ asset('Bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.rtl.min.css') }}">

<style>
        body {
    padding-top: 60px;
    }
    </style>
</head>
<body class="bg-light">
    @yield('navbar')

    @yield('content')

    <!-- Bootstrap JS from both folders for compatibility -->
    <script src="{{ asset('Bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
