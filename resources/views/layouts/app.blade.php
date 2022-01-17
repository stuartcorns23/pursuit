<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body class="">
    <x-layouts.sidebar />
    <x-layouts.topbar />
    @yield('content')
    <x-layouts.footer />
    @yield('modals')
    <script src="{{ asset('js/app.js')}}"></script>
    @yield('js')
</body>
</html>
