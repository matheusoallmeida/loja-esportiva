<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Catálogo</p>
                <h1 class="h3 fw-black mb-0">Produtos e fotos</h1>
            </div>

            <a href="{{ route('produtos.create') }}" class="btn btn-dark fw-bold">Novo produto</a>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container-fluid px-4 px-lg-5">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
            @endif

            <div class="admin-panel">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                    <div>
                        <h2 class="h5 fw-black mb-1">Produtos cadastrados</h2>
                        <p class="text-secondary mb-0">Tudo que for cadastrado aqui entra na vitrine da loja.</p>
                    </div>
                    <a href="{{ url('/') }}#produtos" class="btn btn-outline-dark fw-bold align-self-start">Ver vitrine</a>
                </div>

                <div class="table-responsive">
                    <table class="table admin-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Categoria</th>
                                <th>Tamanho</th>
                                <th>Preço</th>
                                <th>Estoque</th>
                                <th class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produtos as $produto)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="admin-product-thumb">
                                                @if($produto->imagem)
                                                    <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}">
                                                @else
                                                    <span>Sem foto</span>
                                                @endif
                                            </div>
                                            <div>
                                                <strong class="d-block">{{ $produto->nome }}</strong>
                                                <small class="text-secondary">{{ \Illuminate\Support\Str::limit($produto->descricao, 70) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $produto->categoria->nome ?? '-' }}</td>
                                    <td>{{ $produto->tamanho ? $produto->tamanho->sigla . ' - ' . $produto->tamanho->descricao : '-' }}</td>
                                    <td class="fw-bold">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                    <td>
                                        <span class="badge rounded-pill {{ $produto->estoque > 0 ? 'text-bg-light' : 'text-bg-danger' }}">
                                            {{ $produto->estoque }} un.
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('produto.show', $produto->id) }}" class="btn btn-sm btn-outline-dark">Ver</a>
                                            <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-sm btn-dark">Editar</a>
                                            <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja remover este produto?')">Excluir</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-secondary py-5">Nenhum produto cadastrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
