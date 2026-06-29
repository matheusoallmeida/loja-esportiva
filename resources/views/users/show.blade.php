<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Clientes</p>
                <h1 class="h3 fw-black mb-0">Detalhes do cliente</h1>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('users.index') }}" class="btn btn-outline-dark fw-bold">Voltar</a>
                <a href="{{ route('users.edit', $cliente->id) }}" class="btn btn-dark fw-bold">Editar cliente</a>
            </div>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <aside class="admin-panel h-100">
                        <div class="customer-avatar mb-3">
                            {{ strtoupper(substr($cliente->name, 0, 1)) }}
                        </div>

                        <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Cliente #{{ $cliente->id }}</p>
                        <h2 class="h4 fw-black mb-1">{{ $cliente->name }}</h2>
                        <p class="text-secondary mb-4">{{ $cliente->email }}</p>

                        <div class="customer-status">
                            <span>{{ $cliente->role === 'admin' ? 'Administrador' : 'Cliente' }}</span>
                            <strong>Cadastro ativo</strong>
                        </div>
                    </aside>
                </div>

                <div class="col-lg-8">
                    <div class="admin-panel h-100">
                        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                            <div>
                                <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Cadastro</p>
                                <h2 class="h4 fw-black mb-1">Informações pessoais</h2>
                                <p class="text-secondary mb-0">Dados usados para identificação, contato e acompanhamento dos pedidos.</p>
                            </div>
                        </div>

                        <div class="customer-detail-grid">
                            <div>
                                <span>Nome</span>
                                <strong>{{ $cliente->name }}</strong>
                            </div>
                            <div>
                                <span>Email</span>
                                <strong>{{ $cliente->email }}</strong>
                            </div>
                            <div>
                                <span>CPF</span>
                                <strong>{{ $cliente->cpf ?: 'Nao informado' }}</strong>
                            </div>
                            <div>
                                <span>Telefone</span>
                                <strong>{{ $cliente->telefone ?: 'Nao informado' }}</strong>
                            </div>
                            <div>
                                <span>Data de nascimento</span>
                                <strong>{{ $cliente->data_nascimento ? $cliente->data_nascimento->format('d/m/Y') : 'Nao informado' }}</strong>
                            </div>
                            <div>
                                <span>Tipo de acesso</span>
                                <strong>{{ $cliente->role === 'admin' ? 'Administrador' : 'Cliente' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
