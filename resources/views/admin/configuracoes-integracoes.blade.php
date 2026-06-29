<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Operação</p>
                <h1 class="h3 fw-black mb-0">Pagamentos e entregas</h1>
            </div>

            <a href="{{ route('dashboard') }}" class="btn btn-outline-dark fw-bold">Voltar ao dashboard</a>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container">
            @php
                $analyticsUrl = 'https://analytics.google.com/analytics/web/';
            @endphp

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="integration-summary {{ $status['pagamentos'] ? 'is-active' : '' }}">
                        <span>{{ $status['pagamentos'] ? 'Operando' : 'Pendente' }}</span>
                        <strong>Pagamentos</strong>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="integration-summary {{ $status['entregas'] ? 'is-active' : '' }}">
                        <span>{{ $status['entregas'] ? 'Operando' : 'Pendente' }}</span>
                        <strong>Entregas</strong>
                    </div>
                </div>
                <div class="col-md-4">
                    @if($status['analytics'])
                        <a href="{{ $analyticsUrl }}" target="_blank" rel="noopener noreferrer" class="integration-summary is-active">
                            <span>Abrir painel</span>
                            <strong>Analytics</strong>
                        </a>
                    @else
                        <div class="integration-summary">
                            <span>Pendente</span>
                            <strong>Analytics</strong>
                        </div>
                    @endif
                </div>
            </div>

            <div class="admin-panel">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                    <div>
                        <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Operação</p>
                        <h2 class="h4 fw-black mb-1">Resumo de pagamentos e entregas</h2>
                        <p class="text-secondary mb-0">Acompanhe os retornos registrados nas vendas depois que as APIs estiverem configuradas.</p>
                    </div>
                    <a href="{{ route('vendas.index') }}" class="btn btn-dark fw-bold align-self-start">Ver vendas</a>
                </div>

                <div class="row g-3">
                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card">
                            <span>Pagamentos aprovados</span>
                            <strong>{{ $resumo['pagamentos_aprovados'] }}</strong>
                            <small>Retorno registrado na venda</small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card">
                            <span>Pagamentos pendentes</span>
                            <strong>{{ $resumo['pagamentos_pendentes'] }}</strong>
                            <small>Aguardando retorno ou teste final</small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card">
                            <span>Entregas recebidas</span>
                            <strong>{{ $resumo['entregas_recebidas'] }}</strong>
                            <small>Pedido aceito pela logística</small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card">
                            <span>Entregas em rota</span>
                            <strong>{{ $resumo['entregas_em_rota'] }}</strong>
                            <small>Atualizado pelo callback</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
