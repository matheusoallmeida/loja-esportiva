<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonte -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap + Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    {{-- Navbar --}}
    @include('layouts.navigation')

    {{-- Cabeçalho --}}
    @isset($header)
        <header class="bg-light shadow-sm py-4 mb-4">
            <div class="container">
                {{ $header }}
            </div>
        </header>
    @endisset

    {{-- Conteúdo --}}
    <main class="container">
        @yield('content')
    </main>

</body>
</html>