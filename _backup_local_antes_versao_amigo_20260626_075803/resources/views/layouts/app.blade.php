<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'MANTRA') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="site-body">

    @include('layouts.navigation')

    @isset($header)
        <header class="bg-white border-bottom py-3">
            <div class="container">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main>
        @hasSection('content')
            @yield('content')
        @else
            {{ $slot ?? '' }}
        @endif
    </main>

    <div class="modal fade newsletter-modal" id="newsletterModal" tabindex="-1" aria-labelledby="newsletterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <button type="button" class="btn-close newsletter-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

                <div class="newsletter-modal-grid">
                    <div class="newsletter-modal-media"></div>

                    <div class="newsletter-modal-copy">
                        <p class="text-uppercase small fw-bold letter-spaced text-secondary mb-2">MANTRA Club</p>
                        <h2 id="newsletterModalLabel" class="fw-black mb-3">Receba novidades antes de todo mundo</h2>
                        <p class="text-secondary mb-4">Cadastre seu e-mail para acompanhar lançamentos, ofertas e coleções exclusivas.</p>

                        <form id="newsletterForm" class="newsletter-form">
                            <label for="newsletterEmail" class="form-label fw-bold">E-mail</label>
                            <div class="input-group">
                                <input type="email" id="newsletterEmail" class="form-control form-control-lg" placeholder="seuemail@exemplo.com" required>
                                <button class="btn btn-dark fw-bold px-4" type="submit">Cadastrar</button>
                            </div>
                            <small class="newsletter-feedback text-success fw-bold mt-3 d-none">Cadastro recebido. Boas compras!</small>
                        </form>

                        <button type="button" class="btn btn-link text-dark fw-bold p-0 mt-3" data-bs-dismiss="modal">
                            Agora não
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modalElement = document.getElementById('newsletterModal');
            const form = document.getElementById('newsletterForm');

            if (!modalElement || !window.bootstrap) {
                return;
            }

            const storageKey = 'mantra_newsletter_seen';
            const newsletterModal = new bootstrap.Modal(modalElement);
            const storage = {
                get: () => {
                    try {
                        return localStorage.getItem(storageKey);
                    } catch (error) {
                        return null;
                    }
                },
                set: () => {
                    try {
                        localStorage.setItem(storageKey, '1');
                    } catch (error) {
                        //
                    }
                }
            };

            if (!storage.get()) {
                setTimeout(() => newsletterModal.show(), 1200);
            }

            modalElement.addEventListener('hidden.bs.modal', () => {
                storage.set();
            });

            form?.addEventListener('submit', (event) => {
                event.preventDefault();
                form.querySelector('.newsletter-feedback')?.classList.remove('d-none');
                storage.set();
                setTimeout(() => newsletterModal.hide(), 900);
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
