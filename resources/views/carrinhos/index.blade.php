<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Carrinho
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('carrinhos.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                    Adicionar Produto
                </a>

                @if(session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('checkout.finalizar') }}" method="POST" class="mb-4">
                    @csrf

                    <button
                        type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded"
                    >
                        Finalizar Compra
                    </button>
                </form>
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Cliente</th>
                            <th class="p-2 border">Produto</th>
                            <th class="p-2 border">Quantidade</th>
                            <th class="p-2 border">Valor Unitário</th>
                            <th class="p-2 border">Subtotal</th>
                            <th class="p-2 border">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($carrinhos as $carrinho)
                            <tr>
                                <td class="p-2 border">
                                    {{ $carrinho->id }}
                                </td>

                                <td class="p-2 border">
                                    {{ $carrinho->user->name }}
                                </td>

                                <td class="p-2 border">
                                    {{ $carrinho->produto->nome }}
                                </td>

                                <td class="p-2 border">
                                    {{ $carrinho->quantidade }}
                                </td>
                                <td class="p-2 border">
                                    R$ {{ number_format($carrinho->produto->preco, 2, ',', '.') }}
                                </td>

                                <td class="p-2 border">
                                    R$ {{ number_format($carrinho->produto->preco * $carrinho->quantidade, 2, ',', '.') }}
                                </td>
                                <td class="p-2 border">
                                    <a href="{{ route('carrinhos.show', $carrinho->id) }}">
                                        Ver
                                    </a> |

                                    <a href="{{ route('carrinhos.edit', $carrinho->id) }}">
                                        Editar
                                    </a> |

                                    <form action="{{ route('carrinhos.destroy', $carrinho->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Deseja remover este item?')">
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