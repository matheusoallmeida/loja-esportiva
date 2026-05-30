@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section class="bg-dark text-white py-5">

    <div class="container py-5">

        <p class="text-uppercase text-secondary mb-2">
            Nova Coleção 2026
        </p>

        <h1 class="display-3 fw-bold">
            Vista Sua Paixão
        </h1>

        <p class="lead col-md-6">
            Camisas oficiais dos maiores clubes do mundo.
            Estilo, tradição e performance em cada detalhe.
        </p>

        <div class="mt-4">

            <a href="#" class="btn btn-light btn-lg me-2">
                Comprar
            </a>

            <a href="#" class="btn btn-outline-light btn-lg">
                Personalizar
            </a>

        </div>

    </div>

</section>

{{-- PRODUTOS --}}
<section class="py-5">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <small class="text-muted text-uppercase">
                    Produtos em destaque
                </small>

                <h2 class="fw-bold">
                    Mais Vendidos
                </h2>
            </div>

        </div>

        <div class="row g-4">

            @forelse($produtos as $produto)

                <div class="col-md-3">

                    <div class="card h-100 shadow-sm border-0">

                        @if($produto->imagem)

                            <img
                                src="{{ asset('storage/' . $produto->imagem) }}"
                                alt="{{ $produto->nome }}"
                                class="card-img-top"
                                style="height:320px; object-fit:cover;"
                            >

                        @else

                            <div
                                class="bg-light d-flex justify-content-center align-items-center"
                                style="height:320px;"
                            >
                                Sem imagem
                            </div>

                        @endif

                        <div class="card-body">

                            <h5 class="card-title fw-bold">
                                {{ $produto->nome }}
                            </h5>

                            <p class="text-muted mb-2">
                                {{ $produto->categoria->nome ?? 'Sem categoria' }}
                            </p>

                            <h4 class="fw-bold text-dark">
                                R$ {{ number_format($produto->preco, 2, ',', '.') }}
                            </h4>

                            <small class="text-muted">
                                Até 6x sem juros
                            </small>

                        </div>

                        <div class="card-footer bg-white border-0">

                            <a
                                href="{{ route('produto.show', $produto->id) }}"
                                class="btn btn-dark w-100"
                            >
                                Ver Produto
                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-warning">
                        Nenhum produto cadastrado.
                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>

{{-- BANNERS --}}
<section class="py-5 bg-light">

    <div class="container">

        <div class="row g-4">

            <div class="col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body p-5">

                        <h3 class="fw-bold">
                            Personalize do seu jeito
                        </h3>

                        <p class="text-muted">
                            Nome, número e patches oficiais.
                        </p>

                        <a href="#" class="btn btn-dark">
                            Personalizar
                        </a>

                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body p-5">

                        <h3 class="fw-bold">
                            Patches Oficiais
                        </h3>

                        <p class="text-muted">
                            Mostre cada conquista.
                        </p>

                        <a href="#" class="btn btn-dark">
                            Ver Patches
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection