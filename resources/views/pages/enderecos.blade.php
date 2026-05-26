@extends('layouts.app')

@section('content')

<div class="container py-5">

    {{-- TÍTULO --}}
    <div class="d-flex justify-content-between align-items-center mb-5">

        <h1 class="fw-bold">
            Meus Endereços
        </h1>

    </div>

    <div class="row">

        {{-- FORMULÁRIO --}}
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Novo Endereço
                    </h4>

                    <form>

                        <div class="row g-3">

                            {{-- DESCRIÇÃO --}}
                            <div class="col-12">

                                <label class="form-label">
                                    Descrição
                                </label>

                                <input 
                                    type="text"
                                    class="form-control"
                                    placeholder="Casa, Trabalho..."
                                >

                            </div>

                            {{-- CEP --}}
                            <div class="col-md-4">

                                <label class="form-label">
                                    CEP
                                </label>

                                <input 
                                    type="text"
                                    class="form-control"
                                    id="cep"
                                    placeholder="00000-000"
                                >

                            </div>

                            {{-- LOGRADOURO --}}
                            <div class="col-md-8">

                                <label class="form-label">
                                    Rua / Logradouro
                                </label>

                                <input 
                                    type="text"
                                    class="form-control"
                                    id="logradouro"
                                >

                            </div>

                            {{-- NÚMERO --}}
                            <div class="col-md-4">

                                <label class="form-label">
                                    Número
                                </label>

                                <input 
                                    type="text"
                                    class="form-control"
                                    placeholder="123"
                                >

                            </div>

                            {{-- BAIRRO --}}
                            <div class="col-md-8">

                                <label class="form-label">
                                    Bairro
                                </label>

                                <input 
                                    type="text"
                                    class="form-control"
                                    id="bairro"
                                >

                            </div>

                            {{-- CIDADE --}}
                            <div class="col-md-8">

                                <label class="form-label">
                                    Cidade
                                </label>

                                <input 
                                    type="text"
                                    class="form-control"
                                    id="cidade"
                                >

                            </div>

                            {{-- ESTADO --}}
                            <div class="col-md-4">

                                <label class="form-label">
                                    Estado
                                </label>

                                <input 
                                    type="text"
                                    class="form-control"
                                    id="estado"
                                >

                            </div>

                        </div>

                        {{-- BOTÃO --}}
                        <button 
                            type="submit"
                            class="btn btn-dark mt-4 px-5"
                        >
                            Salvar Endereço
                        </button>

                    </form>

                </div>

            </div>

        </div>

        {{-- ENDEREÇOS CADASTRADOS --}}
        <div class="col-lg-5 mt-4 mt-lg-0">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Endereços Salvos
                    </h4>

                    {{-- CARD ENDEREÇO --}}
                    <div class="border rounded p-3 mb-3">

                        <h6 class="fw-bold">
                            Casa
                        </h6>

                        <p class="text-muted mb-1">
                            Rua Exemplo, 123
                        </p>

                        <p class="text-muted mb-1">
                            Centro - Caçador/SC
                        </p>

                        <p class="text-muted mb-3">
                            CEP: 89500-000
                        </p>

                        <div class="d-flex gap-2">

                            <button class="btn btn-outline-dark btn-sm">
                                Editar
                            </button>

                            <button class="btn btn-outline-danger btn-sm">
                                Remover
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection