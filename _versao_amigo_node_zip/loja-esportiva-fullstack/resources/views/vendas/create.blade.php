<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nova Venda
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('vendas.index') }}" class="mb-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">
                    Voltar
                </a>

                @if($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('vendas.store') }}" method="POST" class="mt-4">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Cliente
                        </label>

                        <select
                            name="user_id"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                            required
                        >
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Produto
                        </label>

                        <select
                            id="produto"
                            name="produto_id"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                            required
                        >
                            @foreach($produtos as $produto)
                                <option
                                    value="{{ $produto->id }}"
                                    data-preco="{{ $produto->preco }}"
                                >
                                    {{ $produto->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Quantidade
                        </label>

                        <input
                            type="number"
                            id="quantidade"
                            name="quantidade"
                            value="{{ old('quantidade', 1) }}"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Valor Total
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            id="valor_total"
                            name="valor_total"
                            value="{{ old('valor_total') }}"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                            readonly
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Status
                        </label>

                        <input
                            type="text"
                            name="status"
                            value="{{ old('status') }}"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Status do pagamento
                        </label>

                        <select
                            name="status_pagamento"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                        >
                            <option value="Pendente">Pendente</option>
                            <option value="Aprovado">Aprovado</option>
                            <option value="Negado">Negado</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Status da entrega
                        </label>

                        <select
                            name="status_entrega"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                        >
                            <option value="Aguardando pagamento">Aguardando pagamento</option>
                            <option value="Recebido">Recebido</option>
                            <option value="Em separação">Em separação</option>
                            <option value="Em rota">Em rota</option>
                            <option value="Entregue">Entregue</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                        Salvar
                    </button>

                </form>

            </div>
        </div>
    </div>

    <script>
        const produto = document.getElementById('produto');
        const quantidade = document.getElementById('quantidade');
        const valorTotal = document.getElementById('valor_total');

        function calcularTotal() {
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
</x-app-layout>
