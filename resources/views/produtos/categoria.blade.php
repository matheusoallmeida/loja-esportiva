@extends('layouts.app')

@section('content')

{{-- ========================================
     CATEGORIA DE PRODUTOS
======================================== --}}
<div class="container py-4">

    {{-- TÍTULO --}}
    <h1 class="fw-bold mb-4 text-capitalize">
        {{ $categoria }}
    </h1>

    {{-- GRID DE PRODUTOS --}}
    <div class="row g-4">

        @forelse ($produtos as $produto)

            <div class="col-12 col-sm-6 col-md-4 col-lg-3">

                <div class="card border-0 shadow-sm h-100">

                    {{-- IMAGEM --}}
                    <img 
                        src="/storage/produtos/{{ $produto['imagem'] }}"
                        class="card-img-top"
                        style="height: 250px; object-fit: cover;"
                        alt="{{ $produto['nome'] }}"
                    >

                    {{-- CONTEÚDO --}}
                    <div class="card-body">

                        <h5 class="fw-semibold">
                            {{ $produto['nome'] }}
                        </h5>

                        <p class="text-muted small">
                            {{ $produto['descricao'] ?? 'Produto esportivo premium' }}
                        </p>

                        <h4 class="fw-bold mt-3">
                            R$ {{ number_format((float) $produto['preco'], 2, ',', '.') }}
                        </h4>

                       <a href="/produto/1" class="btn btn-dark w-100 mt-3">
    Ver produto
</a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">
                <div class="alert alert-warning">
                    Nenhum produto encontrado.
                </div>
            </div>

        @endforelse

    </div>

</div>

@endsection