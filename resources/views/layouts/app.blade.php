<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;1,100;1,200;1,300&display=swap" rel="stylesheet"> 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body class="bg-secondary">
    <div class="d-flex vw-100 vh-100 align-items-center justify-content-center">
        <div id="holder" class="border p-4 rounded shadow bg-white w-50">
            <div class="p-2 mb-4 text-center">
                <img src="{{ asset('images/pursuit-tmr-1.jpg')}}" alt="Pursuit TMR" width="300px"/>
            </div>
            <div class="row">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
