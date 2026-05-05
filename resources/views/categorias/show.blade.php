<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes da Categoria
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <p><strong>ID:</strong> {{ $categoria->id }}</p>
                <p><strong>Nome:</strong> {{ $categoria->nome }}</p>
                <p><strong>Categoria Pai:</strong> {{ $categoria->categoriaPai?->nome ?? '-' }}</p>

                <div class="mt-4">
                    <a href="{{ route('categorias.index') }}" class="text-blue-600">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>