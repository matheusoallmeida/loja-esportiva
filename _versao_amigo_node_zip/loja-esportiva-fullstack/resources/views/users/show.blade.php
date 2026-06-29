<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes do Cliente
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <p><strong>ID:</strong> {{ $cliente->id }}</p>
                <p><strong>Nome:</strong> {{ $cliente->name }}</p>
                <p><strong>CPF:</strong> {{ $cliente->cpf }}</p>
                <p><strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($cliente->data_nascimento)->format('d/m/Y') }}</p>
                <p><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
                <p><strong>Email:</strong> {{ $cliente->email }}</p>

                <div class="mt-4">
                    <a href="{{ route('users.index') }}" class="text-blue-600">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>