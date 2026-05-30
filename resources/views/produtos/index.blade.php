<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Produtos
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('produtos.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                    Novo Produto
                </a>

                <!-- Mostra a mensagem de sucesso se algum produto foi criado, editado ou excluído -->
                @if(session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Imagem</th>
                            <th class="p-2 border">Nome</th>
                            <th class="p-2 border">Descrição</th>
                            <th class="p-2 border">Categoria</th>
                            <th class="p-2 border">Tamanho</th>
                            <th class="p-2 border">Preço</th>
                            <th class="p-2 border">Estoque</th>
                            <th class="p-2 border">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td class="p-2 border">{{ $produto->id }}</td>
                                
                                <!-- Busca a foto no storage público ou avisa se estiver sem imagem -->
                                <td class="p-2 border">
                                    @if($produto->imagem)
                                        <img
                                            src="{{ asset('storage/' . $produto->imagem) }}"
                                            alt="{{ $produto->nome }}"
                                            class="w-20 h-20 object-cover rounded"
                                        >
                                    @else
                                        Sem imagem
                                    @endif
                                </td>
                                
                                <td class="p-2 border">{{ $produto->nome }}</td>
                                <td class="p-2 border">{{ $produto->descricao }}</td>
                                <td class="p-2 border">{{ $produto->categoria->nome }}</td>
                                <td class="p-2 border">{{ $produto->tamanho->sigla }} - {{ $produto->tamanho->descricao }}</td>
                                <td class="p-2 border">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                <td class="p-2 border">{{ $produto->estoque }}</td>

                                <!-- Botões para visualizar, editar ou remover o produto da linha atual -->
                                <td class="p-2 border">
                                    <a href="{{ route('produto.show', $produto->id) }}">Ver</a>

                                    <a href="{{ route('produtos.edit', $produto->id) }}">
                                        Editar
                                    </a> 

                                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Deseja remover este produto?')">
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
