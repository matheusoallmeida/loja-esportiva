<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes da Venda
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <div class="mb-4 flex gap-2">
                    <a href="{{ route('vendas.index') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded">
                        Voltar
                    </a>

                    <a href="{{ route('vendas.edit', $venda->id) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded">
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
                                {{ $venda->id }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Cliente
                            </th>

                            <td class="p-2 border">
                                {{ $venda->user->name }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Produto
                            </th>

                            <td class="p-2 border">
                                {{ $venda->produto->nome }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Quantidade
                            </th>

                            <td class="p-2 border">
                                {{ $venda->quantidade }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Valor Total
                            </th>

                            <td class="p-2 border">
                                R$ {{ number_format($venda->valor_total, 2, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Status
                            </th>

                            <td class="p-2 border">
                                {{ $venda->status }}
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>