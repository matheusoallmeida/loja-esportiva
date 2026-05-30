<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <p class="text-uppercase small fw-bold letter-spaced text-secondary mb-2">Entrega</p>
                <h1 class="h2 fw-black mb-0">Meus endereços</h1>
            </div>
            <a href="{{ route('enderecos.create') }}" class="btn btn-dark fw-bold">Novo endereço</a>
        </div>
    </x-slot>

    @php
        $listaEnderecos = auth()->check() && auth()->user()->role === 'cliente'
            ? $enderecos->where('user_id', auth()->id())
            : $enderecos;
    @endphp

    <section class="py-5">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row g-4">
                @forelse($listaEnderecos as $endereco)
                    <div class="col-md-6 col-lg-4">
                        <article class="address-card bg-white border rounded p-4 h-100">
                            <div class="d-flex justify-content-between gap-3 mb-3">
                                <div>
                                    <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Endereço</p>
                                    <h2 class="h5 fw-black mb-0">{{ $endereco->descricao }}</h2>
                                </div>
                                <span class="badge rounded-pill text-bg-light border">#{{ $endereco->id }}</span>
                            </div>

                            <p class="mb-1">{{ $endereco->logradouro }}, {{ $endereco->numero }}</p>
                            <p class="text-secondary mb-1">{{ $endereco->bairro }}</p>
                            <p class="text-secondary mb-3">{{ $endereco->cidade->nome }} - {{ $endereco->cidade->estado }} · CEP {{ $endereco->cep }}</p>

                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('enderecos.show', $endereco->id) }}" class="btn btn-outline-dark btn-sm fw-bold">Ver</a>
                                <a href="{{ route('enderecos.edit', $endereco->id) }}" class="btn btn-dark btn-sm fw-bold">Editar</a>
                                <form action="{{ route('enderecos.destroy', $endereco->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm fw-bold" onclick="return confirm('Deseja remover este endereço?')">
                                        Remover
                                    </button>
                                </form>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state border rounded bg-white p-5 text-center">
                            <h2 class="h4 fw-black">Nenhum endereço cadastrado</h2>
                            <p class="text-secondary">Cadastre um endereço para entrega em uma cidade atendida.</p>
                            <a href="{{ route('enderecos.create') }}" class="btn btn-dark fw-bold">Cadastrar endereço</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
