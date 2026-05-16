<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Produto
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('produtos.index') }}" class="mb-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">
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

                <form action="{{ route('produtos.update', $produto->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Nome
                        </label>

                        <input
                            type="text"
                            name="nome"
                            value="{{ old('nome', $produto->nome) }}"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Descrição
                        </label>

                        <textarea
                            name="descricao"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                            required
                        >{{ old('descricao', $produto->descricao) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Categoria
                        </label>

                        <select
                            name="categoria_id"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                            required
                        >
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ $produto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Tamanho
                        </label>

                        <select
                            name="tamanho_id"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                            required
                        >
                            @foreach($tamanhos as $tamanho)
                                <option value="{{ $tamanho->id }}" {{ $produto->tamanho_id == $tamanho->id ? 'selected' : '' }}>
                                    {{ $tamanho->sigla }} - {{ $tamanho->descricao }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Preço
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="preco"
                            value="{{ old('preco', $produto->preco) }}"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Estoque
                        </label>

                        <input
                            type="number"
                            name="estoque"
                            value="{{ old('estoque', $produto->estoque) }}"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Imagem Atual
                        </label>

                        @if($produto->imagem)
                            <img
                                src="{{ asset('storage/' . $produto->imagem) }}"
                                alt="{{ $produto->nome }}"
                                class="w-32 h-32 object-cover rounded border"
                            >
                        @else
                            <p class="text-gray-500">Sem imagem cadastrada</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">
                            Nova Imagem
                        </label>

                        <input
                            type="file"
                            name="imagem"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
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