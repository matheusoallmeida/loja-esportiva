@extends('layouts.app')

@section('content')

<section class="bg-white py-5">

    <div class="container">

        <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-5">

            <div>

                <p class="text-uppercase small fw-bold text-secondary mb-2">
                    Administração
                </p>

                <h1 class="display-5 fw-black mb-0">
                    Detalhes da Venda
                </h1>

                <p class="text-secondary mt-2">
                    Informações completas do pedido realizado.
                </p>

            </div>


            <div class="d-flex gap-2 align-items-start">

                <a href="{{ route('vendas.index') }}"
                class="btn btn-outline-dark fw-bold px-4 py-2">

                    Voltar

                </a>


                @auth
                    @if(auth()->user()->role === 'admin')

                        <a href="{{ route('vendas.edit', $venda->id) }}"
                        class="btn btn-dark fw-bold px-4 py-2">

                            Editar

                        </a>

                    @endif
                @endauth

            </div>

        </div>


        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">


                <div class="row border-bottom py-3">

                    <div class="col-md-3 fw-bold text-secondary">
                        Pedido
                    </div>

                    <div class="col-md-9">
                        #{{ $venda->id }}
                    </div>

                </div>


                <div class="row border-bottom py-3">

                    <div class="col-md-3 fw-bold text-secondary">
                        Cliente
                    </div>

                    <div class="col-md-9">
                        {{ $venda->user->name }}
                    </div>

                </div>


                <div class="row border-bottom py-3">

                    <div class="col-md-3 fw-bold text-secondary">
                        Produto
                    </div>

                    <div class="col-md-9">
                        {{ $venda->produto->nome }}
                    </div>

                </div>


                <div class="row border-bottom py-3">

                    <div class="col-md-3 fw-bold text-secondary">
                        Quantidade
                    </div>

                    <div class="col-md-9">
                        {{ $venda->quantidade }}
                    </div>

                </div>


                <div class="row border-bottom py-3">

                    <div class="col-md-3 fw-bold text-secondary">
                        Valor Total
                    </div>

                    <div class="col-md-9 fw-bold">

                        R$
                        {{ number_format(
                            $venda->valor_total,
                            2,
                            ',',
                            '.'
                        ) }}

                    </div>

                </div>


                @php
                    $statusPagamento = $venda->status_pagamento ?? ($venda->status === 'Finalizada' ? 'Aprovado' : 'Pendente');
                    $statusEntrega = $venda->status_entrega ?? ($venda->status === 'Finalizada' ? 'Recebido' : 'Aguardando pagamento');
                @endphp

                <div class="row border-bottom py-3">

                    <div class="col-md-3 fw-bold text-secondary">
                        Status da venda
                    </div>

                    <div class="col-md-9">

                        <span class="status-pill is-order">
                            {{ $venda->status }}
                        </span>

                    </div>

                </div>

                <div class="row border-bottom py-3">
                    <div class="col-md-3 fw-bold text-secondary">
                        Status do pagamento
                    </div>

                    <div class="col-md-9">
                        <span class="status-pill is-payment">{{ $statusPagamento }}</span>
                        @if($venda->codigo_pagamento)
                            <p class="text-secondary small mb-0 mt-2">Código CacaPay: {{ $venda->codigo_pagamento }}</p>
                        @endif
                    </div>
                </div>

                <div class="row py-3">
                    <div class="col-md-3 fw-bold text-secondary">
                        Status da entrega
                    </div>

                    <div class="col-md-9">
                        <span class="status-pill is-delivery">{{ $statusEntrega }}</span>
                        @if($venda->codigo_entrega)
                            <p class="text-secondary small mb-0 mt-2">Código CacaLog: {{ $venda->codigo_entrega }}</p>
                        @endif
                        @if($venda->codigo_rastreio)
                            <p class="text-secondary small mb-0 mt-2">Código de rastreio: {{ $venda->codigo_rastreio }}</p>
                        @endif
                        <p class="text-secondary small mb-0 mt-2">Este campo será atualizado pelo callback enviado pelo CacaLog.</p>
                    </div>
                </div>


            </div>

        </div>


    </div>

</section>

@endsection
