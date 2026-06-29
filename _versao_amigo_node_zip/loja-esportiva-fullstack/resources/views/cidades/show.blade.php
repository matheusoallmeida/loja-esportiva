<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Entrega</p>
            <h1 class="h3 fw-black mb-0">Detalhes da cidade</h1>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container">
            <div class="admin-panel admin-form-panel mx-auto">
                <dl class="row mb-0">
                    <dt class="col-sm-4 text-secondary">ID</dt>
                    <dd class="col-sm-8 fw-bold">#{{ $cidade->id }}</dd>

                    <dt class="col-sm-4 text-secondary">Cidade</dt>
                    <dd class="col-sm-8">{{ $cidade->nome }}</dd>

                    <dt class="col-sm-4 text-secondary">Estado</dt>
                    <dd class="col-sm-8"><span class="admin-size-badge">{{ $cidade->estado }}</span></dd>
                </dl>

                <div class="alert alert-light border mt-4 mb-0">
                    Esta cidade fica disponível para o cliente selecionar no cadastro de endereço.
                </div>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    <a href="{{ route('cidades.edit', $cidade->id) }}" class="btn btn-dark fw-bold">Editar</a>
                    <a href="{{ route('cidades.index') }}" class="btn btn-outline-dark fw-bold">Voltar</a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
