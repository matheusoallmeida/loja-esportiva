<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- =========================
        FONTES
    ========================= --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- =========================
        ESTILOS E SCRIPTS (VITE)
    ========================= --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white">

    {{-- =========================
        NAVBAR DO SITE
    ========================= --}}
    @include('layouts.navigation')

    {{-- =========================
        HEADER DA PÁGINA (opcional)
    ========================= --}}
    @isset($header)
        <header class="bg-light border-bottom py-3 mb-4">

            <div class="container">

                {{-- Conteúdo do header vindo das páginas --}}
                {{ $header }}

            </div>

        </header>
    @endisset

    {{-- =========================
        CONTEÚDO PRINCIPAL
    ========================= --}}
    <main class="min-vh-100">

        {{-- Container principal do Bootstrap --}}
        <div class="container py-4">

            @yield('content')

        </div>

    </main>

    {{-- =========================
        FOOTER GLOBAL (opcional futuro)
    ========================= --}}
    <footer class="border-top py-4 mt-5">

        <div class="container text-center text-muted small">

            © 2026 Elite Football Store. Todos os direitos reservados.

        </div>

    </footer>

</body>

</html>