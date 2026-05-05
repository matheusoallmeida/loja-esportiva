<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes da Cidade
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <div class="mb-4 flex gap-2">
                    <a href="{{ route('cidades.index') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded">
                        Voltar
                    </a>
                    <a href="{{ route('cidades.edit', $cidade->id) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded">
                        Editar
                    </a>
                </div>

                <table class="w-full border">
                    <tbody>
                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left w-1/4">ID</th>
                            <td class="p-2 border">{{ $cidade->id }}</td>
                        </tr>
                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left w-1/4">Nome</th>
                            <td class="p-2 border">{{ $cidade->nome }}</td>
                        </tr>
                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left w-1/4">Estado</th>
                            <td class="p-2 border">{{ $cidade->estado }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>