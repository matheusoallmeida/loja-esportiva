<x-app-layout>
    <x-slot name="header">
        <h1 class="h2 fw-black mb-0">Detalhes do endereço</h1>
    </x-slot>

    <section class="py-5">
        <div class="container">
            <div class="bg-white border rounded p-4 p-lg-5">
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <a href="{{ route('enderecos.index') }}" class="btn btn-outline-dark fw-bold">Voltar</a>
                    <a href="{{ route('enderecos.edit', $endereco->id) }}" class="btn btn-dark fw-bold">Editar</a>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Descrição</p>
                        <p class="h5 fw-black">{{ $endereco->descricao }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Cliente</p>
                        <p class="h5 fw-black">{{ $endereco->user->name }}</p>
                    </div>

                    <div class="col-md-8">
                        <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Logradouro</p>
                        <p>{{ $endereco->logradouro }}, {{ $endereco->numero }}</p>
                    </div>

                    <div class="col-md-4">
                        <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">CEP</p>
                        <p>{{ $endereco->cep }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Bairro</p>
                        <p>{{ $endereco->bairro }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Cidade</p>
                        <p>{{ $endereco->cidade->nome }} - {{ $endereco->cidade->estado }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
