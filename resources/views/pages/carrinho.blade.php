@extends('layouts.app')

@section('content')

<div class="container py-5">

    {{-- TÍTULO --}}
    <h1 class="fw-bold mb-5">
        Meu Carrinho
    </h1>

    <div class="row g-5">

        {{-- PRODUTOS --}}
        <div class="col-lg-8">

            {{-- ITEM --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body">

                    <div class="row align-items-center">

                        {{-- IMAGEM --}}
                        <div class="col-md-3">

                            <img 
                                src="{{ asset('img/produtos/camiseta.jpg') }}"
                                class="img-fluid rounded"
                                alt="Produto"
                            >

                        </div>

                        {{-- INFO --}}
                        <div class="col-md-5">

                            <h5 class="fw-bold">
                                Camiseta Dry Fit
                            </h5>

                            <p class="text-muted mb-2">
                                Tamanho: M
                            </p>

                            <p class="text-muted">
                                Cor: Preto
                            </p>

                        </div>

                        {{-- QUANTIDADE --}}
                        <div class="col-md-2">

                            <input 
                                type="number"
                                class="form-control"
                                value="1"
                                min="1"
                            >

                        </div>

                        {{-- PREÇO --}}
                        <div class="col-md-2 text-end">

                            <h5 class="fw-bold">
                                R$ 79,90
                            </h5>

                            <button class="btn btn-sm btn-outline-danger mt-2">
                                Remover
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- RESUMO --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h4 class="fw-bold mb-4">
                        Resumo
                    </h4>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Subtotal</span>
                        <span>R$ 79,90</span>

                    </div>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Frete</span>
                        <span>Grátis</span>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-4">

                        <strong>Total</strong>

                        <strong>
                            R$ 79,90
                        </strong>

                    </div>

                   <a href="/checkout" class="btn btn-dark w-100 btn-lg">
    Finalizar Compra
</a>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection