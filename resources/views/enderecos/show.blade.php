<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes do Endereço
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <div class="mb-4 flex gap-2">
                    <a href="{{ route('enderecos.index') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded">
                        Voltar
                    </a>

                    <a href="{{ route('enderecos.edit', $endereco->id) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded">
                        Editar
                    </a>
                </div>

                <table class="w-full border">
                    <tbody>
                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left w-1/4">
                                ID
                            </th>

                            <td class="p-2 border">
                                {{ $endereco->id }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Cliente
                            </th>

                            <td class="p-2 border">
                                {{ $endereco->user->name }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Cidade
                            </th>

                            <td class="p-2 border">
                                {{ $endereco->cidade->nome }} - {{ $endereco->cidade->estado }}
                            </td>
                        </tr>


                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Rua
                            </th>

                            <td class="p-2 border">
                                {{ $endereco->logradouro }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Número
                            </th>

                            <td class="p-2 border">
                                {{ $endereco->numero }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Bairro
                            </th>

                            <td class="p-2 border">
                                {{ $endereco->bairro }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                CEP
                            </th>

                            <td class="p-2 border">
                                {{ $endereco->cep }}
                            </td>
                        </tr>

                        <tr>
                            <th class="p-2 border bg-gray-100 dark:bg-gray-700 text-left">
                                Descrição
                            </th>

                            <td class="p-2 border">
                                {{ $endereco->descricao }}
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>