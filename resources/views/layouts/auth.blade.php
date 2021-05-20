<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
    <body class="antialiased background-pattern z-10">
        @yield('content')
    </body>

<style>
    .background-pattern {
        background-color: rgb(99, 102, 241);
        background-image: radial-gradient(#1D4ED8 0.9px, rgb(99, 102, 241) 0.9px);
        background-size: 18px 18px;
    }
</style>
</html>
