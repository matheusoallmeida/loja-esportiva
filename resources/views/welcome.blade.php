@extends('layouts.app')

@section('content')
    <section class="hero-mantra">
        <div class="container-fluid px-4 px-lg-5">
            <div class="hero-mantra-content">
                <p class="hero-title fw-black lh-1 mb-3">VISTA<br>SUA PAIXÃO</p>
                <p class="hero-subtitle mb-4">Camisas oficiais dos maiores times do mundo.</p>

                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="#produtos" class="btn btn-light btn-hero fw-bold">Comprar</a>
                    <a href="#personalizar" class="btn btn-light btn-hero fw-bold">Personalizar</a>
                </div>

                <div class="hero-pagination d-flex align-items-end gap-4">
                    <span class="active">01</span>
                    <span>02</span>
                    <span>03</span>
                </div>
            </div>
        </div>
    </section>

    <section id="produtos" class="store-section bg-white py-4 py-lg-5">
        <div class="container-fluid px-4 px-lg-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="section-title mb-0">DESTAQUES</h2>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('produtos.index') }}" class="view-all-link">Gerenciar produtos →</a>
                    @else
                        <a href="{{ route('carrinhos.index') }}" class="view-all-link">Carrinho →</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="view-all-link">Entrar →</a>
                @endauth
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-5 g-4">
                @forelse($produtos as $produto)
                    @php
                        $fallbackImages = [
                            'images/site/colecao-01.png',
                            'images/site/colecao-02.png',
                            'images/site/colecao-03.png',
                            'images/site/banner-hero-alt.png',
                            'images/site/banner-personalizar.png',
                        ];
                        $fallback = $fallbackImages[$loop->index % count($fallbackImages)];
                    @endphp

                    <div class="col">
                        <article class="mantra-product-card h-100">
                            <a href="{{ route('produto.show', $produto->id) }}" class="text-decoration-none text-dark">
                                <div class="mantra-product-media">
                                    @if($produto->imagem)
                                        <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}">
                                    @else
                                        <img src="{{ asset($fallback) }}" alt="{{ $produto->nome }}">
                                    @endif
                                    <span class="favorite-icon">♡</span>
                                </div>

                                <div class="pt-3">
                                    <h3 class="product-name mb-1">{{ $produto->nome }}</h3>
                                    <p class="product-meta mb-2">{{ $produto->categoria->nome ?? 'Masculino' }}</p>
                                    <p class="product-price mb-1">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                                    <p class="product-installments mb-0">Até 6x sem juros</p>
                                </div>
                            </a>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning mb-0">
                            Nenhum produto cadastrado ainda. Cadastre produtos para eles aparecerem aqui na vitrine.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="personalizar" class="promo-section bg-white pb-4 pb-lg-5">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row g-4">
                <div class="col-lg-5">
                    <a href="#produtos" class="promo-card d-block text-decoration-none text-dark">
                        <img src="{{ asset('images/site/banner-personalizar.png') }}" alt="Personalize do seu jeito">
                        <div class="promo-copy">
                            <h2>PERSONALIZE<br>DO SEU JEITO</h2>
                            <p>Adicione nome, número e patches oficiais às camisas do seu time.</p>
                            <span class="btn btn-dark btn-sm fw-bold">Personalizar agora</span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-7">
                    <a href="#produtos" class="promo-card d-block text-decoration-none text-dark">
                        <img src="{{ asset('images/site/banner-patches.png') }}" alt="Patches oficiais">
                        <div class="promo-copy">
                            <h2>PATCHES OFICIAIS<br><span>MOSTRE CADA CONQUISTA</span></h2>
                            <p>Aplique os patches oficiais e celebre cada título.</p>
                            <span class="btn btn-dark btn-sm fw-bold">Ver patches</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="colecoes" class="collections-section py-4 py-lg-5">
        <div class="container-fluid px-4 px-lg-5">
            <div class="collections-panel">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-3">
                        <h2 class="fw-black mb-3">COLEÇÕES<br>EXCLUSIVAS</h2>
                        <p class="text-white-50 mb-4">Estilos únicos para torcedores que vivem o jogo.</p>
                        <a href="#produtos" class="btn btn-light btn-sm fw-bold">Ver coleções</a>
                    </div>

                    <div class="col-lg-9">
                        <div class="row g-3">
                            @foreach([
                                ['img' => 'images/site/colecao-01.png', 'title' => 'Pré-jogo', 'text' => 'Estilo dentro e fora de campo.'],
                                ['img' => 'images/site/colecao-02.png', 'title' => 'Torcedor', 'text' => 'Mostre sua paixão.'],
                                ['img' => 'images/site/colecao-03.png', 'title' => 'Seleções', 'text' => 'Vista as cores do seu país.'],
                            ] as $colecao)
                                <div class="col-md-4">
                                    <a href="#produtos" class="collection-card d-block text-decoration-none">
                                        <img src="{{ asset($colecao['img']) }}" alt="{{ $colecao['title'] }}">
                                        <div class="collection-copy">
                                            <strong>{{ $colecao['title'] }}</strong>
                                            <span>{{ $colecao['text'] }}</span>
                                            <em>→</em>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="site-footer bg-white border-top py-5">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row g-4">
                <div class="col-6 col-lg-2">
                    <h3>AJUDA</h3>
                    <a href="#">Central de Ajuda</a>
                    <a href="{{ route('vendas.index') }}">Pedidos</a>
                    <a href="#">Entregas</a>
                </div>
                <div class="col-6 col-lg-2">
                    <h3>SOBRE A MANTRA</h3>
                    <a href="#">Quem Somos</a>
                    <a href="#">Sustentabilidade</a>
                    <a href="#">Carreiras</a>
                </div>
                <div class="col-6 col-lg-2">
                    <h3>SERVIÇOS</h3>
                    <a href="#personalizar">Personalizar</a>
                    <a href="#produtos">Cartão presente</a>
                </div>
                <div class="col-lg-3 ms-lg-auto">
                    <h3>RECEBA NOVIDADES</h3>
                    <p class="text-secondary small">Cadastre-se e receba novidades e ofertas exclusivas.</p>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Digite seu e-mail">
                        <button class="btn btn-dark fw-bold" type="button">Cadastrar</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
