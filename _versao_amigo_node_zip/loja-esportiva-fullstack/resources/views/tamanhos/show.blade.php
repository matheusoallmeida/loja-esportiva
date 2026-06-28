<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Estoque</p>
            <h1 class="h3 fw-black mb-0">Detalhes do tamanho</h1>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container">
            <div class="admin-panel admin-form-panel mx-auto">
                <dl class="row mb-0">
                    <dt class="col-sm-4 text-secondary">ID</dt>
                    <dd class="col-sm-8 fw-bold">#{{ $tamanho->id }}</dd>

                    <dt class="col-sm-4 text-secondary">Sigla</dt>
                    <dd class="col-sm-8"><span class="admin-size-badge">{{ $tamanho->sigla }}</span></dd>

                    <dt class="col-sm-4 text-secondary">Descrição</dt>
                    <dd class="col-sm-8">{{ $tamanho->descricao }}</dd>
                </dl>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    <a href="{{ route('tamanhos.edit', $tamanho->id) }}" class="btn btn-dark fw-bold">Editar</a>
                    <a href="{{ route('tamanhos.index') }}" class="btn btn-outline-dark fw-bold">Voltar</a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
