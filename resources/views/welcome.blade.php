@extends('layouts.app')

@php
    // =========================
    // LISTA DE PRODUTOS (MOCK)
    // =========================
    $produtos = [
        [
            'nome' => 'Real Madrid 24/25 Stadium Home',
            'categoria' => 'Masculino',
            'preco' => '299,90',
            'imagem' => 'produto1.jpg',
        ],
        [
            'nome' => 'PSG 24/25 Home',
            'categoria' => 'Feminino',
            'preco' => '279,90',
            'imagem' => 'produto2.jpg',
        ],
        [
            'nome' => 'Brasil Infantil',
            'categoria' => 'Infantil',
            'preco' => '199,90',
            'imagem' => 'produto3.jpg',
        ],
        [
            'nome' => 'Barcelona Home 24/25',
            'categoria' => 'Masculino',
            'preco' => '289,90',
            'imagem' => 'produto4.jpg',
        ],
    ];
@endphp

@section('content')

{{-- ========================================
     HERO PRINCIPAL (CSS CUSTOM)
======================================== --}}
<section class="hero-section">

    {{-- Imagem de fundo --}}
    <img 
        src="{{ asset('img/banner2.1.jpg') }}"
        alt="Banner Principal"
        class="hero-image"
    >

    {{-- Overlay escuro --}}
    <div class="hero-overlay"></div>

    {{-- Conteúdo --}}
    <div class="hero-content">

        <div class="container">

            <p class="hero-subtitle">
                Nova Coleção 2026
            </p>

            <h1 class="hero-title">
                Vista Sua <br> Paixão
            </h1>

            <p class="hero-description">
                Camisas oficiais dos maiores clubes do mundo.
                Estilo, tradição e performance em cada detalhe.
            </p>

            <div class="hero-buttons">

                <a href="/lancamentos" class="hero-btn-light">
                    Comprar
                </a>

                <a href="/personalizado" class="hero-btn-outline">
                    Personalizar
                </a>

            </div>

        </div>

    </div>

</section>


{{-- ========================================
     VITRINE DE PRODUTOS
======================================== --}}
<section class="py-5 bg-white">

    <div class="container">

        {{-- Título --}}
        <div class="d-flex justify-content-between align-items-end mb-4">

            <div>
                <small class="text-uppercase text-muted">
                    Produtos em destaque
                </small>

                <h2 class="fw-bold">
                    Mais Vendidos
                </h2>
            </div>

            <a href="/lancamentos" class="text-decoration-none">
                Ver todos
            </a>

        </div>

        {{-- Grid de produtos --}}
        <div class="row g-4">

            @foreach ($produtos as $produto)

                <div class="col-12 col-sm-6 col-lg-3">

                    <div class="card border-0 shadow-sm h-100">

                        {{-- Imagem --}}
                        <img 
                            src="{{ asset('img/' . $produto['imagem']) }}"
                            class="card-img-top"
                            style="height: 320px; object-fit: cover;"
                            alt="{{ $produto['nome'] }}"
                        >

                        <div class="card-body">

                            <h5 class="fw-semibold">
                                {{ $produto['nome'] }}
                            </h5>

                            <small class="text-muted">
                                {{ $produto['categoria'] }}
                            </small>

                            <div class="mt-3">

                                <h4 class="fw-bold mb-1">
                                    R$ {{ $produto['preco'] }}
                                </h4>

                                <small class="text-muted">
                                    Até 6x sem juros
                                </small>

                            </div>

                            <button class="btn btn-dark w-100 mt-3">
                                Comprar
                            </button>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>


{{-- ========================================
     BANNERS
======================================== --}}
<section class="py-5">

    <div class="container">

        <div class="row g-4">

            {{-- Personalização --}}
            <div class="col-lg-6">

                <div class="bg-light p-4 rounded-4 h-100 position-relative overflow-hidden">

                    <h2 class="fw-bold">
                        Personalize do seu jeito
                    </h2>

                    <p class="text-muted">
                        Nome, número e patches oficiais.
                    </p>

                    <a href="/personalizado" class="btn btn-dark">
                        Personalizar
                    </a>

                </div>

            </div>

            {{-- Patches --}}
            <div class="col-lg-6">

                <div class="bg-light p-4 rounded-4 h-100 position-relative overflow-hidden">

                    <h2 class="fw-bold">
                        Patches Oficiais
                    </h2>

                    <p class="text-muted">
                        Mostre cada conquista.
                    </p>

                    <a href="/colecoes" class="btn btn-dark">
                        Ver Patches
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


@endsection