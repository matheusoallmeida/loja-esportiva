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
                        @if($produto->imagem)
                            <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}" class="w-100 h-100 object-fit-cover">
                        @else
                            <div class="placeholder-jersey h-100 text-white p-4 p-md-5 d-flex flex-column justify-content-between">
                                <span class="small fw-bold text-uppercase opacity-75">MANTRA</span>
                                <div>
                                    <div class="placeholder-ball mb-4"></div>
                                    <p class="display-4 fw-black lh-1 mb-0">{{ $produto->nome }}</p>
                                </div>
                                <span class="small fw-semibold opacity-75">Imagem do produto indisponivel</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6">
                    <p class="text-success fw-bold text-uppercase small letter-spaced mb-2">
                        {{ $produto->categoria->nome ?? 'Produto esportivo' }}
                    </p>

                    <h1 class="display-5 fw-black lh-1 mb-4">
                        {{ $produto->nome }}
                    </h1>

                    <p class="display-6 fw-black mb-1">
                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                    </p>

                    <p class="text-secondary mb-4">
                        Ate 6x sem juros. Estoque disponivel: {{ $produto->estoque }} unidade{{ $produto->estoque == 1 ? '' : 's' }}.
                    </p>

                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <p class="text-secondary text-uppercase small fw-bold letter-spaced mb-2">Descricao</p>
                            <p class="mb-0">
                                {{ $produto->descricao }}
                            </p>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="border rounded p-3 h-100">
                                <p class="text-secondary text-uppercase small fw-bold letter-spaced mb-1">Tamanho</p>
                                <p class="fw-black mb-0">{{ $produto->tamanho->sigla ?? 'Unico' }}</p>
                                @if($produto->tamanho?->descricao)
                                    <p class="text-secondary small mb-0">{{ $produto->tamanho->descricao }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="border rounded p-3 h-100">
                                <p class="text-secondary text-uppercase small fw-bold letter-spaced mb-1">Categoria</p>
                                <p class="fw-black mb-0">{{ $produto->categoria->nome ?? 'Sem categoria' }}</p>
                            </div>
                        </div>
                    </div>

                    @auth
                        @if(auth()->user()->role === 'cliente')
                            <form action="{{ route('carrinhos.store') }}" method="POST" class="mb-4">
                                @csrf
                                <input type="hidden" name="produto_id" value="{{ $produto->id }}">

                                <label for="quantidade" class="form-label fw-bold">Quantidade</label>
                                <div class="input-group input-group-lg product-quantity-control">
                                    <input id="quantidade" type="number" name="quantidade" value="1" min="1" max="{{ $produto->estoque }}" class="form-control" required>
                                    <button type="submit" class="btn btn-dark fw-bold">
                                        Adicionar ao carrinho
                                    </button>
                                </div>
                            </form>
                        @endif
                    @endauth

                    <div class="d-flex flex-column flex-sm-row gap-3">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-dark btn-lg fw-bold">
                                Entrar para comprar
                            </a>
                        @endguest

                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-dark btn-lg fw-bold">
                                    Editar produto
                                </a>
                            @endif
                        @endauth

                        <a href="{{ url('/') }}#produtos" class="btn btn-outline-dark btn-lg fw-bold">
                            Continuar vendo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
