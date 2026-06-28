@extends('layouts.app')

@section('content')
    @php
        $itens = auth()->user()->role === 'cliente'
            ? $carrinhos->where('user_id', auth()->id())
            : $carrinhos;

        $total = $itens->sum(fn ($item) => $item->produto->preco * $item->quantidade);
    @endphp

    <section class="bg-white py-5">
        <div class="container">
            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-5">
                <div>
                    <p class="text-uppercase small fw-bold letter-spaced text-secondary mb-2">Carrinho</p>
                    <h1 class="display-5 fw-black mb-0">Sua sacola</h1>
                </div>
                <a href="{{ url('/') }}#produtos" class="btn btn-outline-dark align-self-start fw-bold">
                    Continuar comprando
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="row g-4">
                <div class="col-lg-8">
                    @forelse($itens as $carrinho)
                        <div class="cart-item border-bottom py-4">
                            <div class="row g-3 align-items-center">
                                <div class="col-4 col-md-3">
                                    <div class="cart-thumb bg-light rounded overflow-hidden">
                                        @if($carrinho->produto->imagem)
                                            <img src="{{ asset('storage/' . $carrinho->produto->imagem) }}" alt="{{ $carrinho->produto->nome }}" class="w-100 h-100 object-fit-cover">
                                        @else
                                            <div class="h-100 placeholder-jersey"></div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-8 col-md-5">
                                    <p class="fw-black mb-1">{{ $carrinho->produto->nome }}</p>
                                    <p class="text-secondary small mb-1">{{ $carrinho->produto->categoria->nome ?? 'Produto esportivo' }}</p>
                                    <p class="text-secondary small mb-0">Quantidade: {{ $carrinho->quantidade }}</p>
                                </div>

                                <div class="col-md-2">
                                    <p class="fw-bold mb-0">R$ {{ number_format($carrinho->produto->preco * $carrinho->quantidade, 2, ',', '.') }}</p>
                                </div>

                                <div class="col-md-2 text-md-end">
                                    <form action="{{ route('carrinhos.destroy', $carrinho->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-dark px-0 small fw-bold" onclick="return confirm('Deseja remover este item?')">
                                            Remover
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state border rounded p-5 text-center">
                            <h2 class="h4 fw-black">Sua sacola esta vazia</h2>
                            <p class="text-secondary">Escolha um produto na loja para iniciar a compra.</p>
                            <a href="{{ url('/') }}#produtos" class="btn btn-dark fw-bold">Ver produtos</a>
                        </div>
                    @endforelse
                </div>

                <div class="col-lg-4">
                    <div class="checkout-summary border rounded p-4 sticky-lg-top">
                        <h2 class="h4 fw-black mb-4">Resumo</h2>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-secondary">Subtotal</span>
                            <strong>R$ {{ number_format($total, 2, ',', '.') }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-secondary">Entrega</span>
                            <span>Calculada no fechamento</span>
                        </div>

                        <form action="{{ route('checkout.finalizar') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-dark btn-lg w-100 fw-bold" {{ $itens->isEmpty() ? 'disabled' : '' }}>
                                Fechar compra
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
