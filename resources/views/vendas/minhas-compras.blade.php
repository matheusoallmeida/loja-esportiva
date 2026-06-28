@extends('layouts.app')

@section('content')

<section class="bg-white py-5">

    <div class="container">

        <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-5">

            <div>
                <p class="text-uppercase small fw-bold letter-spaced text-secondary mb-2">
                    Cliente
                </p>

                <h1 class="display-5 fw-black mb-0">
                    Minhas compras
                </h1>

                <p class="text-secondary mt-2 mb-0">
                    Aqui você acompanha os pedidos realizados na loja.
                </p>
            </div>

            <a href="{{ url('/') }}#produtos" class="btn btn-outline-dark align-self-start fw-bold">
                Comprar novamente
            </a>

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
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                        <th>Status da venda</th>
                        <th>Pagamento</th>
                        <th>Entrega</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($vendas as $venda)

                        <tr>

                            <td class="fw-bold">
                                #{{ $venda->id }}
                            </td>

                            <td>
                                {{ $venda->produto->nome ?? 'Produto removido' }}
                            </td>

                            <td>
                                {{ $venda->quantidade }}
                            </td>

                            <td class="fw-bold">
                                R$ {{ number_format($venda->valor_total, 2, ',', '.') }}
                            </td>

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

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center py-5">

                                <p class="h5 fw-black">
                                    Nenhuma compra encontrada
                                </p>

                                <p class="text-secondary mb-3">
                                    Quando uma compra for fechada, ela aparecerá aqui.
                                </p>

                                <a href="{{ url('/') }}#produtos" class="btn btn-dark fw-bold">
                                    Ir para loja
                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</section>

@endsection
