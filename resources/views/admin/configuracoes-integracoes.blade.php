<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Integrações</p>
                <h1 class="h3 fw-black mb-0">Configurações externas</h1>
            </div>

            <a href="{{ route('dashboard') }}" class="btn btn-outline-dark fw-bold">Voltar ao dashboard</a>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
            @endif

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="admin-panel">
                        <div class="mb-4">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">APIs REST</p>
                            <h2 class="h4 fw-black mb-1">Dados de conexão</h2>
                            <p class="text-secondary mb-0">Tela preparada para armazenar URLs e tokens usados pelo sistema nas integrações.</p>
                        </div>

                        <form method="POST" action="#">
                            @csrf

                            <div class="integration-block mb-4">
                                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mb-3">
                                    <div>
                                        <h3 class="h5 fw-black mb-1">Caçapay</h3>
                                        <p class="text-secondary mb-0">API responsável por aprovar ou negar o pagamento.</p>
                                    </div>
                                    <span class="integration-status is-ready">Configurável</span>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label for="cacapay_url" class="form-label fw-bold">URL da API Caçapay</label>
                                        <input type="url" id="cacapay_url" name="cacapay_url" class="form-control form-control-lg" placeholder="https://cacapay.exemplo.test/api">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cacapay_token" class="form-label fw-bold">Token</label>
                                        <input type="password" id="cacapay_token" name="cacapay_token" class="form-control form-control-lg" placeholder="********">
                                    </div>
                                </div>
                            </div>

                            <div class="integration-block mb-4">
                                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mb-3">
                                    <div>
                                        <h3 class="h5 fw-black mb-1">Caçalog</h3>
                                        <p class="text-secondary mb-0">API responsável por receber o pedido de entrega e enviar atualizações.</p>
                                    </div>
                                    <span class="integration-status is-ready">Configurável</span>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label for="cacalog_url" class="form-label fw-bold">URL da API Caçalog</label>
                                        <input type="url" id="cacalog_url" name="cacalog_url" class="form-control form-control-lg" placeholder="https://cacalog.exemplo.test/api">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cacalog_token" class="form-label fw-bold">Token</label>
                                        <input type="password" id="cacalog_token" name="cacalog_token" class="form-control form-control-lg" placeholder="********">
                                    </div>
                                    <div class="col-12">
                                        <label for="callback_url" class="form-label fw-bold">Callback para status de entrega</label>
                                        <input type="url" id="callback_url" name="callback_url" class="form-control form-control-lg" value="{{ url('/api/entregas/status') }}">
                                        <small class="text-secondary">Endereço informado ao Caçalog para receber mudanças como recebido, em rota e entregue.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="integration-block">
                                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mb-3">
                                    <div>
                                        <h3 class="h5 fw-black mb-1">Google Analytics</h3>
                                        <p class="text-secondary mb-0">Monitoramento de acessos e comportamento dos visitantes.</p>
                                    </div>
                                    <span class="integration-status">Opcional</span>
                                </div>

                                <label for="google_analytics_id" class="form-label fw-bold">Measurement ID</label>
                                <input type="text" id="google_analytics_id" name="google_analytics_id" class="form-control form-control-lg" placeholder="G-XXXXXXXXXX">
                            </div>

                            <div class="d-flex flex-wrap gap-2 mt-4">
                                <button type="button" class="btn btn-dark fw-bold">Salvar configurações</button>
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-dark fw-bold">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="admin-panel h-100">
                        <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Fluxo da compra</p>
                        <h2 class="h5 fw-black mb-4">Como a integração aparece no sistema</h2>

                        <div class="integration-flow">
                            <div>
                                <span>01</span>
                                <strong>Cliente finaliza compra</strong>
                                <p>O checkout envia CPF e valor para validação.</p>
                            </div>
                            <div>
                                <span>02</span>
                                <strong>Caçapay aprova ou nega</strong>
                                <p>O status de pagamento fica visível na venda.</p>
                            </div>
                            <div>
                                <span>03</span>
                                <strong>Caçalog recebe entrega</strong>
                                <p>Dados de cliente, endereço, CEP e produtos são enviados.</p>
                            </div>
                            <div>
                                <span>04</span>
                                <strong>Status volta pelo callback</strong>
                                <p>A venda mostra andamento da entrega para admin e cliente.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
