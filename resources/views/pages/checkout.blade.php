@extends('layouts.app')

@section('content')

<div class="container py-5">

    {{-- TÍTULO --}}
    <h1 class="fw-bold mb-5">
        Finalizar Compra
    </h1>

    <div class="row g-5">

        {{-- FORMULÁRIO --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    {{-- ENDEREÇO --}}
                    <h4 class="fw-bold mb-4">
                        Endereço de Entrega
                    </h4>

                    <div class="row g-3">

                        {{-- Nome --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Nome Completo
                            </label>

                            <input 
                                type="text"
                                class="form-control"
                                placeholder="Digite seu nome"
                            >

                        </div>

                        {{-- Telefone --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Telefone
                            </label>

                            <input 
                                type="text"
                                class="form-control"
                                placeholder="(00) 00000-0000"
                            >

                        </div>

                        {{-- Endereço --}}
                        <div class="col-12">

                            <label class="form-label">
                                Endereço
                            </label>

                            <input 
                                type="text"
                                class="form-control"
                                placeholder="Rua, avenida..."
                            >

                        </div>

                        {{-- Cidade --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Cidade
                            </label>

                            <input 
                                type="text"
                                class="form-control"
                                placeholder="Sua cidade"
                            >

                        </div>

                        {{-- CEP --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                CEP
                            </label>

                            <input 
                                type="text"
                                class="form-control"
                                placeholder="00000-000"
                            >

                        </div>

                    </div>

                    {{-- PAGAMENTO --}}
                    <h4 class="fw-bold mt-5 mb-4">
                        Forma de Pagamento
                    </h4>

                    <div class="form-check mb-3">

                        <input 
                            class="form-check-input"
                            type="radio"
                            name="pagamento"
                            checked
                        >

                        <label class="form-check-label">
                            Cartão de Crédito
                        </label>

                    </div>

                    <div class="form-check mb-3">

                        <input 
                            class="form-check-input"
                            type="radio"
                            name="pagamento"
                        >

                        <label class="form-check-label">
                            PIX
                        </label>

                    </div>

                    <div class="form-check">

                        <input 
                            class="form-check-input"
                            type="radio"
                            name="pagamento"
                        >

                        <label class="form-check-label">
                            Boleto Bancário
                        </label>

                    </div>

                </div>

            </div>

        </div>

        {{-- RESUMO --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Resumo do Pedido
                    </h4>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Produtos</span>
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

                    <button class="btn btn-dark w-100 btn-lg">
                        Finalizar Pedido
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection