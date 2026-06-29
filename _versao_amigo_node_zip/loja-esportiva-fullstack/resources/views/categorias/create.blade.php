<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Catálogo</p>
            <h1 class="h3 fw-black mb-0">Nova categoria</h1>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container">
            <div class="admin-panel admin-form-panel mx-auto">
                <form method="POST" action="{{ route('categorias.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="nome" class="form-label fw-bold">Nome da categoria</label>
                        <input type="text" id="nome" name="nome" value="{{ old('nome') }}" class="form-control form-control-lg" placeholder="Ex: Masculino" required>
                        @error('nome') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="categoria_pai" class="form-label fw-bold">Categoria pai</label>
                        <select id="categoria_pai" name="categoria_pai" class="form-select form-select-lg">
                            <option value="">Nenhuma, será categoria principal</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" @selected(old('categoria_pai') == $categoria->id)>{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
                        @error('categoria_pai') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark fw-bold">Salvar categoria</button>
                        <a href="{{ route('categorias.index') }}" class="btn btn-outline-dark fw-bold">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
