<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Cliente
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('users.update', $cliente->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label>Nome</label>
                        <input type="text" name="name" value="{{ old('name', $cliente->name) }}" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label>CPF</label>
                        <input type="text" name="cpf" value="{{ old('cpf', $cliente->cpf) }}" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label>Data de Nascimento</label>
                        <input type="date" name="data_nascimento" value="{{ old('data_nascimento', $cliente->data_nascimento) }}" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label>Telefone</label>
                        <input type="text" name="telefone" value="{{ old('telefone', $cliente->telefone) }}" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', $cliente->email) }}" class="w-full border rounded p-2">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                        Salvar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>