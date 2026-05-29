<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Cidades
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('cidades.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                    Nova Cidade
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
                            <th class="p-2 border">Nome</th>
                            <th class="p-2 border">Estado</th>
                            <th class="p-2 border">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cidades as $cidade)
                            <tr>
                                <td class="p-2 border">{{ $cidade->id }}</td>
                                <td class="p-2 border">{{ $cidade->nome }}</td>
                                <td class="p-2 border">{{ $cidade->estado }}</td>
                                <td class="p-2 border">
                                    <a href="{{ route('cidades.show', $cidade->id) }}">Ver</a> |
                                    <a href="{{ route('cidades.edit', $cidade->id) }}">Editar</a> |
                                    <form action="{{ route('cidades.destroy', $cidade->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Deseja remover esta cidade?')">
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