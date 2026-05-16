<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes do Produto
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <div class="mb-4 flex gap-2">
                    <a href="{{ route('produtos.index') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded">
                        Voltar
                    </a>

                    <a href="{{ route('produtos.edit', $produto->id) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded">
                        Editar
                    </a>
                </div>

                <table class="w-full border">
                    <tbody>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left w-1/4">
                                ID
                            </th>

                            <td class="p-2 border">
                                {{ $produto->id }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Imagem
                            </th>

                            <td class="p-2 border">
                                @if($produto->imagem)
                                    <img
                                        src="{{ asset('storage/' . $produto->imagem) }}"
                                        alt="{{ $produto->nome }}"
                                        class="w-64 rounded shadow"
                                    >
                                @else
                                    <p>Sem imagem cadastrada</p>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Nome
                            </th>

                            <td class="p-2 border">
                                {{ $produto->nome }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Descrição
                            </th>

                            <td class="p-2 border">
                                {{ $produto->descricao }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Categoria
                            </th>

                            <td class="p-2 border">
                                {{ $produto->categoria->nome }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Tamanho
                            </th>

                            <td class="p-2 border">
                                {{ $produto->tamanho->sigla }} - {{ $produto->tamanho->descricao }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Preço
                            </th>

                            <td class="p-2 border">
                                R$ {{ number_format($produto->preco, 2, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Estoque
                            </th>

                            <td class="p-2 border">
                                {{ $produto->estoque }}
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>