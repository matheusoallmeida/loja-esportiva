<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Endereços
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('enderecos.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                    Novo Endereço
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
                            <th class="p-2 border">Cidade</th>
                            <th class="p-2 border">Logradouro</th>
                            <th class="p-2 border">Número</th>
                            <th class="p-2 border">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enderecos as $endereco)
                            <tr>
                                <td class="p-2 border">{{ $endereco->id }}</td>
                                <td class="p-2 border">{{ $endereco->user->name }}</td>
                                <td class="p-2 border">{{ $endereco->cidade->nome }}</td>
                                <td class="p-2 border">{{ $endereco->logradouro }}</td>
                                <td class="p-2 border">{{ $endereco->numero }}</td>
                                <td class="p-2 border">
                                    <a href="{{ route('enderecos.show', $endereco->id) }}">Ver</a> |
                                    <a href="{{ route('enderecos.edit', $endereco->id) }}">Editar</a> |
                                    <form action="{{ route('enderecos.destroy', $endereco->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Deseja remover este endereço?')">
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