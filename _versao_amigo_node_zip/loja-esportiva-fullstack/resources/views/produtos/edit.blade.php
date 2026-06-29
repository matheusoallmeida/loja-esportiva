<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Catálogo</p>
            <h1 class="h3 fw-black mb-0">Editar produto</h1>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container">
            <div class="admin-panel">
                @if($errors->any())
                    <div class="alert alert-danger border-0">
                        <strong>Confira os campos:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('produtos.update', $produto->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="nome" class="form-label fw-bold">Nome do produto</label>
                                    <input type="text" id="nome" name="nome" value="{{ old('nome', $produto->nome) }}" class="form-control form-control-lg" required>
                                </div>

                                <div class="col-12">
                                    <label for="descricao" class="form-label fw-bold">Descrição</label>
                                    <textarea id="descricao" name="descricao" class="form-control" rows="5" required>{{ old('descricao', $produto->descricao) }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="categoria_id" class="form-label fw-bold">Categoria</label>
                                    <select id="categoria_id" name="categoria_id" class="form-select form-select-lg" required>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" @selected(old('categoria_id', $produto->categoria_id) == $categoria->id)>{{ $categoria->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="tamanho_id" class="form-label fw-bold">Tamanho</label>
                                    <select id="tamanho_id" name="tamanho_id" class="form-select form-select-lg" required>
                                        @foreach($tamanhos as $tamanho)
                                            <option value="{{ $tamanho->id }}" @selected(old('tamanho_id', $produto->tamanho_id) == $tamanho->id)>{{ $tamanho->sigla }} - {{ $tamanho->descricao }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="preco" class="form-label fw-bold">Preço</label>
                                    <input type="number" step="0.01" min="0" id="preco" name="preco" value="{{ old('preco', $produto->preco) }}" class="form-control form-control-lg" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="estoque" class="form-label fw-bold">Quantidade em estoque</label>
                                    <input type="number" min="0" id="estoque" name="estoque" value="{{ old('estoque', $produto->estoque) }}" class="form-control form-control-lg" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div id="foto-produto" class="admin-upload-box h-100">
                                <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Foto do produto</p>
                                <h2 class="h5 fw-black mb-3">Imagem atual</h2>
                                <div class="admin-current-image mb-3">
                                    @if($produto->imagem)
                                        <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}">
                                    @else
                                        <span>Sem imagem cadastrada</span>
                                    @endif
                                </div>
                                <label for="imagem" class="form-label fw-bold">Trocar imagem</label>
                                <input type="file" id="imagem" name="imagem" class="form-control" accept="image/png,image/jpeg,image/webp">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-dark fw-bold">Salvar alterações</button>
                        <a href="{{ route('produtos.index') }}" class="btn btn-outline-dark fw-bold">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
