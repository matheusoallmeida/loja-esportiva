<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Clientes
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

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
                            <th class="p-2 border">CPF</th>
                            <th class="p-2 border">Email</th>
                            <th class="p-2 border">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td class="p-2 border">{{ $cliente->id }}</td>
                                <td class="p-2 border">{{ $cliente->name }}</td>
                                <td class="p-2 border">{{ $cliente->cpf }}</td>
                                <td class="p-2 border">{{ $cliente->email }}</td>
                                <td class="p-2 border">
                                    <a href="{{ route('users.show', $cliente->id) }}" class="text-blue-600">Ver</a> |
                                    <a href="{{ route('users.edit', $cliente->id) }}" class="text-yellow-600">Editar</a> |
                                    <form action="{{ route('users.destroy', $cliente->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600" onclick="return confirm('Deseja remover este cliente?')">
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