@extends('layouts.app')

@section('content')
    <section class="bg-white py-5">
        <div class="container">
            <a href="{{ url('/') }}#produtos" class="btn btn-link px-0 text-dark fw-bold mb-4">
                Voltar para a loja
            </a>

            <div class="row g-5 align-items-start">
                <div class="col-lg-6">
                    <div class="product-detail-image border rounded overflow-hidden bg-light">
                        <img src="{{ asset($produto['imagem']) }}" alt="{{ $produto['nome'] }}" class="w-100 h-100 object-fit-cover">
                    </div>
                </div>

                <div class="col-lg-6">
                    <p class="text-success fw-bold text-uppercase small letter-spaced mb-2">
                        {{ $produto['categoria'] }}
                    </p>

                    <h1 class="display-5 fw-black lh-1 mb-4">
                        {{ $produto['nome'] }}
                    </h1>

                    <p class="display-6 fw-black mb-1">
                        R$ {{ number_format($produto['preco'], 2, ',', '.') }}
                    </p>

                    <p class="text-secondary mb-4">
                        Até 6x sem juros. Estoque demonstrativo: {{ $produto['estoque'] }} unidades.
                    </p>

                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <p class="text-secondary text-uppercase small fw-bold letter-spaced mb-2">Descrição</p>
                            <p class="mb-0">{{ $produto['descricao'] }}</p>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="border rounded p-3 h-100">
                                <p class="text-secondary text-uppercase small fw-bold letter-spaced mb-1">Tamanho</p>
                                <p class="fw-black mb-0">{{ $produto['tamanho'] }}</p>
                                <p class="text-secondary small mb-0">Selecione no cadastro real do produto.</p>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="border rounded p-3 h-100">
                                <p class="text-secondary text-uppercase small fw-bold letter-spaced mb-1">Categoria</p>
                                <p class="fw-black mb-0">{{ $produto['categoria'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="quantidade" class="form-label fw-bold">Quantidade</label>
                        <div class="input-group input-group-lg product-quantity-control">
                            <input id="quantidade" type="number" value="1" min="1" max="{{ $produto['estoque'] }}" class="form-control">
                            <button type="button" class="btn btn-dark fw-bold" disabled>
                                Adicionar ao carrinho
                            </button>
                        </div>
                        <p class="text-secondary small mt-2 mb-0">
                            Produto demonstrativo para ajustar o front. Quando o produto vier do banco, este botão usa o carrinho real.
                        </p>
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-dark btn-lg fw-bold">
                            Entrar para comprar
                        </a>

                        <a href="{{ url('/') }}#produtos" class="btn btn-outline-dark btn-lg fw-bold">
                            Continuar vendo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
