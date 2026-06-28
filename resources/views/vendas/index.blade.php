@extends('layouts.app')

@section('content')
    @php
        $listaVendas = auth()->check() && auth()->user()->role === 'cliente'
            ? $vendas->where('user_id', auth()->id())
            : $vendas;
    @endphp

    <section class="bg-white py-5">
        <div class="container">
            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-5">
                <div>
                    <p class="text-uppercase small fw-bold letter-spaced text-secondary mb-2">
                        {{ auth()->check() && auth()->user()->role === 'cliente' ? 'Cliente' : 'Admin' }}
                    </p>
                    <h1 class="display-5 fw-black mb-0">
                        {{ auth()->check() && auth()->user()->role === 'cliente' ? 'Minhas compras' : 'Vendas' }}
                    </h1>
                </div>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('vendas.create') }}" class="btn btn-dark align-self-start fw-bold">
                            Nova venda
                        </a>
                    @else
                        <a href="{{ url('/') }}#produtos" class="btn btn-outline-dark align-self-start fw-bold">
                            Comprar novamente
                        </a>
                    @endif
                @endauth
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive border rounded">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Pedido</th>
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <th>Cliente</th>
                                @endif
                            @endauth
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                            <th>Status da venda</th>
                            <th>Pagamento</th>
                            <th>Entrega</th>
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <th class="text-end">Acoes</th>
                                @endif
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($listaVendas as $venda)
                            <tr>
                                <td class="fw-bold">#{{ $venda->id }}</td>

                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <td>{{ $venda->user->name }}</td>
                                    @endif
                                @endauth

                                <td>{{ $venda->produto->nome }}</td>
                                <td>{{ $venda->quantidade }}</td>
                                <td class="fw-bold">R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                                @php
                                    $statusPagamento = $venda->status_pagamento ?? ($venda->status === 'Finalizada' ? 'Aprovado' : 'Pendente');
                                    $statusEntrega = $venda->status_entrega ?? ($venda->status === 'Finalizada' ? 'Recebido' : 'Aguardando pagamento');
                                @endphp

                                <td><span class="status-pill is-order">{{ $venda->status }}</span></td>
                                <td>
                                    <span class="status-pill is-payment">{{ $statusPagamento }}</span>
                                    @if($venda->codigo_pagamento)
                                        <small class="d-block text-secondary mt-1">{{ $venda->codigo_pagamento }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="status-pill is-delivery">{{ $statusEntrega }}</span>
                                    @if($venda->codigo_entrega)
                                        <small class="d-block text-secondary mt-1">{{ $venda->codigo_entrega }}</small>
                                    @endif
                                </td>

                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <td class="text-end">
                                            <div class="d-inline-flex gap-2">
                                                <a href="{{ route('vendas.show', $venda->id) }}" class="btn btn-outline-dark btn-sm">Ver</a>
                                                <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-dark btn-sm">Editar</a>
                                            </div>
                                        </td>
                                    @endif
                                @endauth
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <p class="h5 fw-black">Nenhuma compra encontrada</p>
                                    <p class="text-secondary mb-0">Quando uma compra for fechada, ela aparecera aqui.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
