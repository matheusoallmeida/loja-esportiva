@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row g-5">

        {{-- IMAGEM --}}
        <div class="col-md-6">

            <img 
                src="/storage/{{ $produto['imagem'] }}"
                class="img-fluid rounded shadow-sm"
                alt="{{ $produto['nome'] }}"
            >

        </div>

        {{-- INFO --}}
        <div class="col-md-6">

            <h1 class="fw-bold mb-3">
                {{ $produto['nome'] }}
            </h1>

            <h3 class="text-success mb-3">
                R$ {{ number_format($produto['preco'], 2, ',', '.') }}
            </h3>

            <p class="text-muted mb-4">
                {{ $produto['descricao'] }}
            </p>

            <button class="btn btn-dark btn-lg w-100">
                Adicionar ao Carrinho 
            </button>

            <a href="/carrinho" class="btn btn-outline-dark w-100 mt-3">
    Ver Carrinho
</a>

        </div>

    </div>

</div>

@endsection