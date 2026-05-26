@extends('layouts.app')

@section('content')

<div class="container py-5">

    {{-- TÍTULO --}}
    <div class="mb-5">

        <h1 class="fw-bold">
            Novo Produto
        </h1>

        <p class="text-muted">
            Cadastre um novo produto na loja
        </p>

    </div>

    {{-- FORMULÁRIO --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form>

                <div class="row">

                    {{-- NOME --}}
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">
                            Nome do Produto
                        </label>

                        <input 
                            type="text"
                            class="form-control"
                            placeholder="Digite o nome do produto"
                        >

                    </div>

                    {{-- SLUG --}}
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">
                            Slug
                        </label>

                        <input 
                            type="text"
                            class="form-control"
                            placeholder="camisa-real-madrid"
                        >

                    </div>

                    {{-- PREÇO --}}
                    <div class="col-md-4 mb-4">

                        <label class="form-label fw-semibold">
                            Preço
                        </label>

                        <input 
                            type="number"
                            class="form-control"
                            placeholder="0.00"
                        >

                    </div>

                    {{-- ESTOQUE --}}
                    <div class="col-md-4 mb-4">

                        <label class="form-label fw-semibold">
                            Estoque
                        </label>

                        <input 
                            type="number"
                            class="form-control"
                            placeholder="Quantidade"
                        >

                    </div>

                    {{-- CATEGORIA --}}
                    <div class="col-md-4 mb-4">

                        <label class="form-label fw-semibold">
                            Categoria
                        </label>

                        <select class="form-select">

                            <option>
                                Masculino
                            </option>

                            <option>
                                Feminino
                            </option>

                            <option>
                                Infantil
                            </option>

                            <option>
                                Ofertas
                            </option>

                        </select>

                    </div>

                    {{-- TAMANHO --}}
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">
                            Tamanho
                        </label>

                        <select class="form-select">

                            <option>P</option>
                            <option>M</option>
                            <option>G</option>
                            <option>GG</option>

                        </select>

                    </div>

                    {{-- IMAGEM --}}
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">
                            Foto do Produto
                        </label>

                        <input 
                            type="file"
                            class="form-control"
                        >

                    </div>

                    {{-- DESCRIÇÃO --}}
                    <div class="col-12 mb-4">

                        <label class="form-label fw-semibold">
                            Descrição
                        </label>

                        <textarea 
                            class="form-control"
                            rows="5"
                            placeholder="Descrição do produto..."
                        ></textarea>

                    </div>

                </div>

                {{-- BOTÕES --}}
                <div class="d-flex gap-3">

                    <button class="btn btn-dark px-4">

                        Salvar Produto

                    </button>

                    <a href="/admin/produtos" class="btn btn-outline-secondary">

                        Cancelar

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection