@extends('layouts.app')

@section('content')
    <section class="admin-page py-5">
        <div class="container">
            <div class="admin-hero dashboard-hero mb-4">
                <div>
                    <p class="text-uppercase small fw-bold text-white-50 mb-2">MANTRA Analytics</p>
                    <h1 class="display-6 fw-black mb-2">Dashboard gerencial</h1>
                    <p class="mb-0 text-white-50">Acompanhe vendas, faturamento, produtos, clientes e integrações.</p>
                </div>
                <a href="{{ url('/admin/configuracoes-integracoes') }}" class="btn btn-light fw-bold">Configurar APIs</a>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card">
                        <span>Vendas</span>
                        <strong>{{ $metricas['vendas'] ?? 0 }}</strong>
                        <small>Pedidos registrados</small>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card">
                        <span>Faturamento</span>
                        <strong>R$ {{ number_format($metricas['faturamento'] ?? 0, 2, ',', '.') }}</strong>
                        <small>Total vendido</small>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card">
                        <span>Produtos</span>
                        <strong>{{ $metricas['produtos'] ?? 0 }}</strong>
                        <small>Itens no catálogo</small>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card">
                        <span>Clientes</span>
                        <strong>{{ $metricas['clientes'] ?? 0 }}</strong>
                        <small>Usuários compradores</small>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-8">
                    <div class="admin-panel h-100">
                        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                            <div>
                                <h2 class="h5 fw-black mb-1">Faturamento mensal</h2>
                                <p class="text-secondary mb-0">Gráfico preparado com Chart.js para leitura gerencial.</p>
                            </div>
                            <span class="dashboard-chip">Chart.js</span>
                        </div>
                        <div class="chart-box">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="admin-panel h-100">
                        <h2 class="h5 fw-black mb-1">Status dos pedidos</h2>
                        <p class="text-secondary mb-4">Distribuição das vendas por situação.</p>
                        <div class="chart-box chart-box-small">
                            <canvas id="ordersChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6 col-xl-3">
                    <a href="{{ url('/admin/produtos/novo') }}" class="admin-action d-block text-decoration-none h-100">
                        <span>01</span>
                        <h3>Adicionar produto</h3>
                        <p>Cadastre nome, descrição, preço, estoque, categoria e tamanho.</p>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ url('/admin/produtos/novo#foto-produto') }}" class="admin-action d-block text-decoration-none h-100">
                        <span>02</span>
                        <h3>Adicionar foto</h3>
                        <p>Envie a imagem do produto para aparecer na vitrine e no detalhe.</p>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ url('/admin/configuracoes-integracoes') }}" class="admin-action d-block text-decoration-none h-100">
                        <span>03</span>
                        <h3>Configurar integrações</h3>
                        <p>Informe URLs e tokens de Caçapay, Caçalog e Analytics.</p>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ url('/admin/produtos') }}" class="admin-action d-block text-decoration-none h-100">
                        <span>04</span>
                        <h3>Gerenciar catálogo</h3>
                        <p>Acesse os produtos cadastrados para revisar a vitrine.</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const revenueContext = document.getElementById('revenueChart');
        const ordersContext = document.getElementById('ordersChart');

        if (revenueContext) {
            new Chart(revenueContext, {
                type: 'line',
                data: {
                    labels: @json($chartFaturamento['labels'] ?? []),
                    datasets: [{
                        label: 'Faturamento',
                        data: @json($chartFaturamento['values'] ?? []),
                        borderColor: '#111',
                        backgroundColor: 'rgba(17, 17, 17, .08)',
                        fill: true,
                        tension: .35,
                        pointRadius: 4,
                        pointBackgroundColor: '#111'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: '#eee' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        }

        if (ordersContext) {
            new Chart(ordersContext, {
                type: 'doughnut',
                data: {
                    labels: @json($chartVendas['labels'] ?? []),
                    datasets: [{
                        data: @json($chartVendas['values'] ?? []),
                        backgroundColor: ['#111', '#198754', '#dc3545', '#adb5bd'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '68%',
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        }
    </script>
@endsection
