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
                    <div class="integration-summary {{ $status['analytics'] ? 'is-active' : '' }}">
                        <span>{{ $status['analytics'] ? 'Ativo' : 'Pendente' }}</span>
                        <strong>Analytics</strong>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="admin-panel h-100">
                        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                            <div>
                                <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Operação</p>
                                <h2 class="h4 fw-black mb-1">Status de compra e transporte</h2>
                                <p class="text-secondary mb-0">Admin e cliente acompanham o resultado do pagamento e o andamento da entrega diretamente nas vendas.</p>
                            </div>
                            <a href="{{ route('vendas.index') }}" class="btn btn-dark fw-bold align-self-start">Ver vendas</a>
                        </div>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="metric-card">
                                    <span>Pagamentos aprovados</span>
                                    <strong>{{ $resumo['pagamentos_aprovados'] }}</strong>
                                    <small>Retorno registrado na venda</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="metric-card">
                                    <span>Pagamentos pendentes</span>
                                    <strong>{{ $resumo['pagamentos_pendentes'] }}</strong>
                                    <small>Aguardando retorno ou teste final</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="metric-card">
                                    <span>Entregas recebidas</span>
                                    <strong>{{ $resumo['entregas_recebidas'] }}</strong>
                                    <small>Pedido aceito pela logística</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="metric-card">
                                    <span>Entregas em rota</span>
                                    <strong>{{ $resumo['entregas_em_rota'] }}</strong>
                                    <small>Atualizado pelo callback</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="admin-panel h-100">
                        <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Fluxo visível</p>
                        <h2 class="h5 fw-black mb-4">O que aparece para o usuário</h2>

                        <div class="integration-flow">
                            <div><span>01</span><strong>Compra criada</strong><p>O cliente vê o pedido em “Minhas compras”.</p></div>
                            <div><span>02</span><strong>Status de pagamento</strong><p>A venda mostra se o pagamento está pendente, aprovado ou negado.</p></div>
                            <div><span>03</span><strong>Status de entrega</strong><p>Admin e cliente acompanham recebido, em rota e entregue.</p></div>
                            <div><span>04</span><strong>Atualização automática</strong><p>Quando a logística envia retorno, a venda é atualizada pelo sistema.</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
