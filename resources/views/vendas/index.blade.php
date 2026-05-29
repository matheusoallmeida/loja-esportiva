<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Vendas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('vendas.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                    Nova Venda
                </a>

                @if(session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Cliente</th>
                            <th class="p-2 border">Produto</th>
                            <th class="p-2 border">Quantidade</th>
                            <th class="p-2 border">Valor Total</th>
                            <th class="p-2 border">Status</th>
                            <th class="p-2 border">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($vendas as $venda)
                            <tr>
                                <td class="p-2 border">{{ $venda->id }}</td>

                                <td class="p-2 border">
                                    {{ $venda->user->name }}
                                </td>

                                <td class="p-2 border">
                                    {{ $venda->produto->nome }}
                                </td>

                                <td class="p-2 border">
                                    {{ $venda->quantidade }}
                                </td>

                                <td class="p-2 border">
                                    R$ {{ number_format($venda->valor_total, 2, ',', '.') }}
                                </td>

                                <td class="p-2 border">
                                    {{ $venda->status }}
                                </td>

                                <td class="p-2 border">
                                    <a href="{{ route('vendas.show', $venda->id) }}">
                                        Ver
                                    </a> |

                                    <a href="{{ route('vendas.edit', $venda->id) }}">
                                        Editar
                                    </a> |

                                    <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Deseja remover esta venda?')">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>
</x-app-layout>