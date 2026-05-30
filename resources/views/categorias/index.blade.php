<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Catálogo</p>
                <h1 class="h3 fw-black mb-0">Categorias</h1>
            </div>

            <a href="{{ route('categorias.create') }}" class="btn btn-dark fw-bold">Nova categoria</a>
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
                        <h2 class="h5 fw-black mb-1">Categorias cadastradas</h2>
                        <p class="text-secondary mb-0">Organize masculino, feminino, infantil, lançamentos e subcategorias.</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-dark fw-bold align-self-start">Voltar ao painel</a>
                </div>

                <div class="table-responsive">
                    <table class="table admin-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Categoria pai</th>
                                <th class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categorias as $categoria)
                                <tr>
                                    <td class="text-secondary">#{{ $categoria->id }}</td>
                                    <td class="fw-bold">{{ $categoria->nome }}</td>
                                    <td>{{ $categoria->categoriaPai?->nome ?? 'Categoria principal' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('categorias.show', $categoria->id) }}" class="btn btn-sm btn-outline-dark">Ver</a>
                                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-sm btn-dark">Editar</a>
                                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja remover esta categoria?')">Excluir</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-secondary py-5">Nenhuma categoria cadastrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
