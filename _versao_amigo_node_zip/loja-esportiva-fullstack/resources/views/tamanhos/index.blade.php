<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Estoque</p>
                <h1 class="h3 fw-black mb-0">Tamanhos</h1>
            </div>

            <a href="{{ route('tamanhos.create') }}" class="btn btn-dark fw-bold">Novo tamanho</a>
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
                        <h2 class="h5 fw-black mb-1">Tamanhos cadastrados</h2>
                        <p class="text-secondary mb-0">Esses tamanhos são usados no cadastro dos produtos.</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-dark fw-bold align-self-start">Voltar ao painel</a>
                </div>

                <div class="table-responsive">
                    <table class="table admin-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sigla</th>
                                <th>Descrição</th>
                                <th class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tamanhos as $tamanho)
                                <tr>
                                    <td class="text-secondary">#{{ $tamanho->id }}</td>
                                    <td><span class="admin-size-badge">{{ $tamanho->sigla }}</span></td>
                                    <td>{{ $tamanho->descricao }}</td>
                                    <td>
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('tamanhos.show', $tamanho->id) }}" class="btn btn-sm btn-outline-dark">Ver</a>
                                            <a href="{{ route('tamanhos.edit', $tamanho->id) }}" class="btn btn-sm btn-dark">Editar</a>
                                            <form action="{{ route('tamanhos.destroy', $tamanho->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja remover este tamanho?')">Excluir</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-secondary py-5">Nenhum tamanho cadastrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
