<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tamanhos
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('tamanhos.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                    Novo Tamanho
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
                            <th class="p-2 border">Sigla</th>
                            <th class="p-2 border">Descrição</th>
                            <th class="p-2 border">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tamanhos as $tamanho)
                            <tr>
                                <td class="p-2 border">{{ $tamanho->id }}</td>
                                <td class="p-2 border">{{ $tamanho->sigla }}</td>
                                <td class="p-2 border">{{ $tamanho->descricao }}</td>
                                <td class="p-2 border">
                                    <a href="{{ route('tamanhos.show', $tamanho->id) }}">Ver</a> |
                                    <a href="{{ route('tamanhos.edit', $tamanho->id) }}">Editar</a> |
                                    <form action="{{ route('tamanhos.destroy', $tamanho->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Deseja remover este tamanho?')">
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