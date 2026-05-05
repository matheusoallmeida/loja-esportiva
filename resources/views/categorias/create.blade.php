<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nova Categoria
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('categorias.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label>Nome</label>
                        <input type="text" name="nome" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label>Categoria Pai</label>
                        <select name="categoria_pai" class="w-full border rounded p-2">
                            <option value="">Nenhuma</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                        Salvar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>