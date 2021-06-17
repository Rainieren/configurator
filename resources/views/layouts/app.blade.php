<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mountain-iT Product Configurator</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
    <body class="antialiased">
        <div id="app">
            @yield('content')
        </div>
    </body>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</html>
