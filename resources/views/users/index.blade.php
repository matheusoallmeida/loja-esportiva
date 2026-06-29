<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Administracao</p>
                <h1 class="h3 fw-black mb-0">Clientes</h1>
            </div>

            <a href="{{ route('dashboard') }}" class="btn btn-outline-dark fw-bold">Voltar ao dashboard</a>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container">
            <div class="admin-panel">
                @if(session('success'))
                    <div class="alert alert-success fw-semibold mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                    <div>
                        <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Base de clientes</p>
                        <h2 class="h4 fw-black mb-1">Usuarios compradores</h2>
                        <p class="text-secondary mb-0">Consulte dados cadastrais e acesse as acoes de manutencao.</p>
                    </div>

                    <span class="dashboard-chip align-self-start">{{ $clientes->count() }} clientes</span>
                </div>

                <div class="table-responsive">
                    <table class="table admin-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>CPF</th>
                                <th>Email</th>
                                <th class="text-end">Acoes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clientes as $cliente)
                                <tr>
                                    <td class="fw-bold">#{{ $cliente->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="table-avatar">
                                                {{ strtoupper(substr($cliente->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <strong class="d-block">{{ $cliente->name }}</strong>
                                                <small class="text-secondary">{{ $cliente->telefone ?: 'Telefone nao informado' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $cliente->cpf ?: 'Nao informado' }}</td>
                                    <td>{{ $cliente->email }}</td>
                                    <td>
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('users.show', $cliente->id) }}" class="btn btn-sm btn-outline-dark fw-bold">Ver</a>
                                            <a href="{{ route('users.edit', $cliente->id) }}" class="btn btn-sm btn-dark fw-bold">Editar</a>
                                            <form action="{{ route('users.destroy', $cliente->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger fw-bold" onclick="return confirm('Deseja remover este cliente?')">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-secondary py-5">
                                        Nenhum cliente cadastrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
