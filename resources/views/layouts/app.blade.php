<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Medieor')</title>

    <!-- Fonts -->

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/home.css') }}">

    @yield('styles')
</head>

<body>

    @yield('content')

    @yield('scripts')
</body>

</html>
