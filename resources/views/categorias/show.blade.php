<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Catálogo</p>
            <h1 class="h3 fw-black mb-0">Detalhes da categoria</h1>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container">
            <div class="admin-panel admin-form-panel mx-auto">
                <dl class="row mb-0">
                    <dt class="col-sm-4 text-secondary">ID</dt>
                    <dd class="col-sm-8 fw-bold">#{{ $categoria->id }}</dd>

                    <dt class="col-sm-4 text-secondary">Nome</dt>
                    <dd class="col-sm-8">{{ $categoria->nome }}</dd>

                    <dt class="col-sm-4 text-secondary">Categoria pai</dt>
                    <dd class="col-sm-8">{{ $categoria->categoriaPai?->nome ?? 'Categoria principal' }}</dd>
                </dl>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-dark fw-bold">Editar</a>
                    <a href="{{ route('categorias.index') }}" class="btn btn-outline-dark fw-bold">Voltar</a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
