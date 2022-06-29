<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> @yield('title')</title>
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/ui@latest/dist/tailwind-ui.min.css"> --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}
        <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
        @livewireStyles
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    </head>
    <body class="antialiased font-sans bg-gray-200">
        @yield('content')
        @livewireScripts
        <script src="https://unpkg.com/moment"></script>
        <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    </body>
</html>
