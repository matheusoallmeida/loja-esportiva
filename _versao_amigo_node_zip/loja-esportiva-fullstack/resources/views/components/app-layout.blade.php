<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-light bg-white border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">Loja</a>

        <div>
            @auth
                <a href="/dashboard" class="btn btn-outline-dark btn-sm">
                    Dashboard
                </a>
            @else
                <a href="/login" class="btn btn-dark btn-sm">
                    Entrar
                </a>
            @endauth
        </div>
    </div>
</nav>

<div class="container py-4">

    <!-- HEADER -->
    @isset($header)
        <div class="mb-3">
            {{ $header }}
        </div>
    @endisset

    <!-- CONTEÚDO -->
@yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>