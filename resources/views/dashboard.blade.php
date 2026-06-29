<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">
                    {{ auth()->user()->role === 'admin' ? 'Administração' : 'Cliente' }}
                </p>
                <h1 class="h3 fw-black mb-0">
                    {{ auth()->user()->role === 'admin' ? 'Dashboard gerencial' : 'Minha conta' }}
                </h1>
            </div>

            <a href="{{ url('/') }}" class="btn btn-outline-dark fw-bold">Ver loja</a>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container">
            @if(auth()->user()->role === 'admin')
                <div class="admin-hero dashboard-hero mb-4">
                    <div>
                        <p class="text-uppercase small fw-bold text-white-50 mb-2">MANTRA Analytics</p>
                        <h2 class="display-6 fw-black mb-2">Visão geral da operação</h2>
                        <p class="mb-0 text-white-50">Acompanhe vendas, faturamento, produtos, clientes, pagamentos e entregas.</p>
                    </div>
                    <a href="{{ route('admin.configuracoes') }}" class="btn btn-light fw-bold">Pagamentos e entregas</a>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-sm-6 col-xl-3"><div class="metric-card"><span>Vendas</span><strong>{{ $metricas['vendas'] ?? 0 }}</strong><small>Pedidos registrados</small></div></div>
                    <div class="col-sm-6 col-xl-3"><div class="metric-card"><span>Faturamento</span><strong>R$ {{ number_format($metricas['faturamento'] ?? 0, 2, ',', '.') }}</strong><small>Total vendido</small></div></div>
                    <div class="col-sm-6 col-xl-3"><div class="metric-card"><span>Produtos</span><strong>{{ $metricas['produtos'] ?? 0 }}</strong><small>Itens no catálogo</small></div></div>
                    <div class="col-sm-6 col-xl-3"><div class="metric-card"><span>Clientes</span><strong>{{ $metricas['clientes'] ?? 0 }}</strong><small>Usuários compradores</small></div></div>
                </div>

                @php
                    $analyticsUrl = 'https://analytics.google.com/analytics/web/';

                    $integracoesStatus = [
                        'Pagamentos' => filled($integracoes['cacapay_url'] ?? null) && filled($integracoes['cacapay_token'] ?? null),
                        'Entregas' => filled($integracoes['cacalog_url'] ?? null) && filled($integracoes['cacalog_token'] ?? null),
                        'Analytics' => filled($integracoes['google_analytics_id'] ?? null),
                    ];
                @endphp

                <div class="row g-3 mb-4">
                    @foreach($integracoesStatus as $nome => $ativo)
                        <div class="col-md-4">
                            @if($nome === 'Analytics' && $ativo)
                                <a href="{{ $analyticsUrl }}" target="_blank" rel="noopener noreferrer" class="integration-summary is-active">
                                    <span>Abrir painel</span>
                                    <strong>{{ $nome }}</strong>
                                </a>
                            @else
                                <div class="integration-summary {{ $ativo ? 'is-active' : '' }}">
                                    <span>{{ $ativo ? 'Configurado' : 'Pendente' }}</span>
                                    <strong>{{ $nome }}</strong>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-lg-8">
                        <div class="admin-panel h-100">
                            <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                                <div><h2 class="h5 fw-black mb-1">Faturamento mensal</h2><p class="text-secondary mb-0">Gráfico preparado com Chart.js para leitura gerencial.</p></div>
                                <span class="dashboard-chip">Chart.js</span>
                            </div>
                            <div class="chart-box"><canvas id="revenueChart"></canvas></div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="admin-panel h-100">
                            <h2 class="h5 fw-black mb-1">Status dos pedidos</h2>
                            <p class="text-secondary mb-4">Distribuição das vendas por situação.</p>
                            <div class="chart-box chart-box-small"><canvas id="ordersChart"></canvas></div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-lg-4">
                        <div class="admin-panel h-100">
                            <h2 class="h5 fw-black mb-1">Status dos pagamentos</h2>
                            <p class="text-secondary mb-4">Retornos registrados pela CacaPay.</p>
                            <div class="chart-box chart-box-small"><canvas id="paymentsChart"></canvas></div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="admin-panel h-100">
                            <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                                <div><h2 class="h5 fw-black mb-1">Ações rápidas</h2><p class="text-secondary mb-0">Acesse as áreas principais da operação administrativa.</p></div>
                                <span class="dashboard-chip">Admin</span>
                            </div>

                            <div class="api-timeline">
                                <a href="{{ route('vendas.index') }}">
                                    <span>01</span>
                                    <strong>Vendas</strong>
                                    <p>Acompanhar pedidos, pagamento, entrega e rastreio.</p>
                                </a>
                                <a href="{{ route('produtos.index') }}">
                                    <span>02</span>
                                    <strong>Produtos</strong>
                                    <p>Gerenciar catálogo, estoque e informações dos itens.</p>
                                </a>
                                <a href="{{ route('admin.configuracoes') }}">
                                    <span>03</span>
                                    <strong>Integrações</strong>
                                    <p>Ver status de CacaPay, CacaLog e Analytics.</p>
                                </a>
                                <a href="{{ route('users.index') }}">
                                    <span>04</span>
                                    <strong>Clientes</strong>
                                    <p>Consultar usuários cadastrados no sistema.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6 col-xl-3"><a href="{{ route('categorias.create') }}" class="admin-action d-block text-decoration-none h-100"><span>01</span><h3>Adicionar categoria</h3><p>Crie categorias principais e subcategorias para organizar o menu.</p></a></div>
                    <div class="col-md-6 col-xl-3"><a href="{{ route('produtos.create') }}" class="admin-action d-block text-decoration-none h-100"><span>02</span><h3>Adicionar produto</h3><p>Cadastre nome, descrição, preço, estoque, categoria e tamanho.</p></a></div>
                    <div class="col-md-6 col-xl-3"><a href="{{ route('vendas.index') }}" class="admin-action d-block text-decoration-none h-100"><span>03</span><h3>Acompanhar vendas</h3><p>Veja status de pagamento, entrega e códigos de acompanhamento.</p></a></div>
                    <div class="col-md-6 col-xl-3"><a href="{{ route('admin.configuracoes') }}" class="admin-action d-block text-decoration-none h-100"><span>04</span><h3>Pagamentos e entregas</h3><p>Acompanhe aprovações, pendências e transporte dos pedidos.</p></a></div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6 col-lg-3"><a href="{{ route('categorias.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark"><p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Catálogo</p><h2 class="h4 fw-black">Categorias</h2><p class="text-secondary mb-0">Listar, editar e remover categorias.</p></a></div>
                    <div class="col-md-6 col-lg-3"><a href="{{ route('produtos.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark"><p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Catálogo</p><h2 class="h4 fw-black">Produtos e fotos</h2><p class="text-secondary mb-0">Gerenciar produtos cadastrados e suas imagens.</p></a></div>
                    <div class="col-md-6 col-lg-3"><a href="{{ route('tamanhos.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark"><p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Estoque</p><h2 class="h4 fw-black">Tamanhos</h2><p class="text-secondary mb-0">Listar e editar tamanhos disponíveis.</p></a></div>
                    <div class="col-md-6 col-lg-3"><a href="{{ route('cidades.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark"><p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Entrega</p><h2 class="h4 fw-black">Cidades</h2><p class="text-secondary mb-0">Listar cidades atendidas pela loja.</p></a></div>
                </div>
            @else
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3"><a href="{{ route('profile.edit') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark"><p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Cliente</p><h2 class="h4 fw-black">Meu cadastro</h2><p class="text-secondary mb-0">Atualize nome, email, senha e dados da sua conta.</p></a></div>
                    <div class="col-md-6 col-lg-3"><a href="{{ route('enderecos.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark"><p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Cliente</p><h2 class="h4 fw-black">Endereços</h2><p class="text-secondary mb-0">Cadastre locais de entrega na cidade atendida.</p></a></div>
                    <div class="col-md-6 col-lg-3"><a href="{{ route('carrinhos.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark"><p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Cliente</p><h2 class="h4 fw-black">Carrinho</h2><p class="text-secondary mb-0">Revise sua sacola e finalize a compra.</p></a></div>
                    <div class="col-md-6 col-lg-3"><a href="{{ route('cliente.compras') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark"><p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Cliente</p><h2 class="h4 fw-black">Minhas compras</h2><p class="text-secondary mb-0">Acompanhe compras, pagamento e entrega.</p></a></div>
                </div>

                <div class="mt-4"><a href="{{ url('/') }}#produtos" class="btn btn-dark fw-bold">Continuar comprando</a></div>
            @endif
        </div>
    </section>

    @if(auth()->user()->role === 'admin')
        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const revenueContext = document.getElementById('revenueChart');
                const ordersContext = document.getElementById('ordersChart');
                const paymentsContext = document.getElementById('paymentsChart');

                if (revenueContext) {
                    new Chart(revenueContext, {
                        type: 'line',
                        data: { labels: @json($chartFaturamento['labels'] ?? []), datasets: [{ label: 'Faturamento', data: @json($chartFaturamento['values'] ?? []), borderColor: '#111', backgroundColor: 'rgba(17, 17, 17, .08)', fill: true, tension: .35, pointRadius: 4, pointBackgroundColor: '#111' }] },
                        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: '#eee' } }, x: { grid: { display: false } } } }
                    });
                }

                if (ordersContext) {
                    new Chart(ordersContext, {
                        type: 'doughnut',
                        data: { labels: @json($chartVendas['labels'] ?? []), datasets: [{ data: @json($chartVendas['values'] ?? []), backgroundColor: ['#111', '#198754', '#dc3545', '#adb5bd'], borderWidth: 0 }] },
                        options: { responsive: true, maintainAspectRatio: false, cutout: '68%', plugins: { legend: { position: 'bottom' } } }
                    });
                }

                if (paymentsContext) {
                    new Chart(paymentsContext, {
                        type: 'bar',
                        data: { labels: @json($chartPagamentos['labels'] ?? []), datasets: [{ label: 'Pagamentos', data: @json($chartPagamentos['values'] ?? []), backgroundColor: ['#adb5bd', '#198754', '#dc3545', '#111'], borderRadius: 6 }] },
                        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#eee' } }, x: { grid: { display: false } } } }
                    });
                }
            </script>
        @endpush
    @endif
</x-app-layout>
