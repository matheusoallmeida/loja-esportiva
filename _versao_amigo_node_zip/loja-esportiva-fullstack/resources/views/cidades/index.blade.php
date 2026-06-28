<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Entrega</p>
                <h1 class="h3 fw-black mb-0">Cidades atendidas</h1>
            </div>

            <a href="{{ route('cidades.create') }}" class="btn btn-dark fw-bold">Nova cidade</a>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
            @endif

            <div class="admin-panel">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                    <div>
                        <h2 class="h5 fw-black mb-1">Locais de entrega</h2>
                        <p class="text-secondary mb-0">Essas cidades aparecem para o cliente ao cadastrar o endereço.</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-dark fw-bold align-self-start">Voltar ao painel</a>
                </div>

                <div class="table-responsive">
                    <table class="table admin-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cidade</th>
                                <th>UF</th>
                                <th class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cidades as $cidade)
                                <tr>
                                    <td class="text-secondary">#{{ $cidade->id }}</td>
                                    <td class="fw-bold">{{ $cidade->nome }}</td>
                                    <td><span class="admin-size-badge">{{ $cidade->estado }}</span></td>
                                    <td>
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('cidades.show', $cidade->id) }}" class="btn btn-sm btn-outline-dark">Ver</a>
                                            <a href="{{ route('cidades.edit', $cidade->id) }}" class="btn btn-sm btn-dark">Editar</a>
                                            <form action="{{ route('cidades.destroy', $cidade->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja remover esta cidade?')">Excluir</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-secondary py-5">Nenhuma cidade cadastrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
