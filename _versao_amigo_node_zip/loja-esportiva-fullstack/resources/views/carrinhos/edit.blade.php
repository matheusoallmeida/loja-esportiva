<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Carrinho
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('carrinhos.index') }}" class="mb-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">
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

                <form action="{{ route('carrinhos.update', $carrinho->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Produto
                        </label>

                        <select
                            name="produto_id"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                            required
                        >
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}" {{ $carrinho->produto_id == $produto->id ? 'selected' : '' }}>
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
                            name="quantidade"
                            value="{{ old('quantidade', $carrinho->quantidade) }}"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                            required
                        >
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                        Salvar
                    </button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>