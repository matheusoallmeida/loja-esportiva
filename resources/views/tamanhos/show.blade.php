<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes do Tamanho
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <p><strong>ID:</strong> {{ $tamanho->id }}</p>
                <p><strong>Sigla:</strong> {{ $tamanho->sigla }}</p>
                <p><strong>Descrição:</strong> {{ $tamanho->descricao }}</p>

                <div class="mt-4">
                    <a href="{{ route('tamanhos.index') }}" class="text-blue-600">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>