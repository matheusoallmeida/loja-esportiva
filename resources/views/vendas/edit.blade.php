@extends('layouts.app')

@section('content')

<section class="bg-white py-5">

    <div class="container">

        <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-5">

            <div>
                <p class="text-uppercase small fw-bold text-secondary mb-2">
                    Administração
                </p>

                <h1 class="display-5 fw-black mb-0">
                    Editar Venda
                </h1>

                <p class="text-secondary mt-2">
                    Atualize as informações do pedido.
                </p>
            </div>


            <a href="{{ route('vendas.index') }}"
               class="btn btn-outline-dark fw-bold align-self-start px-4 py-2">

                Voltar

            </a>

        </div>


        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif



        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">


                <form action="{{ route('vendas.update', $venda->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')


                    <!-- Cliente -->
                    <div class="mb-4">

                        <label class="form-label fw-bold">
                            Cliente
                        </label>


                        <select name="user_id"
                                class="form-select"
                                required>

                            @foreach($users as $user)

                                <option value="{{ $user->id }}"
                                    {{ $venda->user_id == $user->id ? 'selected' : '' }}>

                                    {{ $user->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>



                    <!-- Produto -->
                    <div class="mb-4">

                        <label class="form-label fw-bold">
                            Produto
                        </label>


                        <select id="produto"
                                name="produto_id"
                                class="form-select"
                                required>


                            @foreach($produtos as $produto)

                                <option
                                    value="{{ $produto->id }}"
                                    data-preco="{{ $produto->preco }}"
                                    {{ $venda->produto_id == $produto->id ? 'selected' : '' }}>


                                    {{ $produto->nome }}

                                </option>


                            @endforeach


                        </select>

                    </div>




                    <!-- Quantidade -->
                    <div class="mb-4">

                        <label class="form-label fw-bold">
                            Quantidade
                        </label>


                        <input
                            type="number"
                            id="quantidade"
                            name="quantidade"
                            value="{{ old('quantidade', $venda->quantidade) }}"
                            class="form-control"
                            required>

                    </div>




                    <!-- Valor -->
                    <div class="mb-4">

                        <label class="form-label fw-bold">
                            Valor Total
                        </label>


                        <input
                            type="number"
                            step="0.01"
                            id="valor_total"
                            name="valor_total"
                            value="{{ old('valor_total', $venda->valor_total) }}"
                            class="form-control"
                            readonly>

                    </div>




                    <!-- Status -->
                    <div class="mb-4">

                        <label class="form-label fw-bold">
                            Status
                        </label>


                        <select name="status"
                                class="form-select">


                            <option value="Pendente"
                                {{ $venda->status == 'Pendente' ? 'selected' : '' }}>

                                Pendente

                            </option>


                            <option value="Finalizada"
                                {{ $venda->status == 'Finalizada' ? 'selected' : '' }}>

                                Finalizada

                            </option>


                            <option value="Cancelada"
                                {{ $venda->status == 'Cancelada' ? 'selected' : '' }}>

                                Cancelada

                            </option>


                        </select>

                    </div>




                    <button type="submit"
                            class="btn btn-dark fw-bold px-4">

                        Salvar alterações

                    </button>


                </form>


            </div>

        </div>


    </div>

</section>



<script>

const produto = document.getElementById('produto');

const quantidade = document.getElementById('quantidade');

const valorTotal = document.getElementById('valor_total');


function calcularTotal()
{

    const preco = parseFloat(
        produto.options[produto.selectedIndex].dataset.preco
    );


    const qtd = parseInt(quantidade.value) || 0;


    valorTotal.value = (preco * qtd).toFixed(2);

}


produto.addEventListener('change', calcularTotal);

quantidade.addEventListener('input', calcularTotal);


calcularTotal();


</script>


@endsection