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

    @if(config('services.google_analytics.measurement_id'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google_analytics.measurement_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ config('services.google_analytics.measurement_id') }}');
        </script>
    @endif

    @stack('head')

    {{-- =========================
        ESTILOS E SCRIPTS (VITE)
    ========================= --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    {{-- =========================
        NAVBAR FIXA GLOBAL
    ========================= --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top border-bottom shadow-sm">

        <div class="container">

            {{-- LOGO --}}
            <a class="navbar-brand fw-bold" href="/">
                Elite Football
            </a>

            {{-- BOTÃO MOBILE --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- MENU --}}
            <div class="collapse navbar-collapse" id="navbarMain">

                {{-- LINKS --}}
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="/lancamentos">Lançamentos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/categoria/masculino">Masculino</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/categoria/feminino">Feminino</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/infantil">Infantil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/ofertas">Ofertas</a>
                    </li>

                </ul>

                {{-- DIREITA (USUÁRIO) --}}
                <div class="d-flex gap-3">

                    @auth
                        <a href="/dashboard" class="btn btn-outline-dark btn-sm">
                            {{ Auth::user()->name }}
                        </a>
                    @else
                        <a href="/login" class="btn btn-dark btn-sm">
                            Entrar
                        </a>
                    @endauth

                </div>

            </div>

        </div>

    </nav>

    {{-- ESPAÇO POR CAUSA DA NAV FIXA --}}
    <div style="height: 70px;"></div>

    {{-- HEADER OPCIONAL --}}
    @isset($header)
        <header class="bg-light border-bottom py-3">
            <div class="container">
                {{ $header }}
            </div>
        </header>
    @endisset

    {{-- CONTEÚDO --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="border-top py-4 mt-5">
        <div class="container text-center text-muted small">
            © 2026 Elite Football Store
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
