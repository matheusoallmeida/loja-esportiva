<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Entrega</p>
            <h1 class="h3 fw-black mb-0">Nova cidade atendida</h1>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container">
            <div class="admin-panel admin-form-panel mx-auto">
                <form action="{{ route('cidades.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="nome" class="form-label fw-bold">Nome da cidade</label>
                            <input type="text" id="nome" name="nome" value="{{ old('nome') }}" class="form-control form-control-lg" placeholder="Caçador" required>
                            @error('nome') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="estado" class="form-label fw-bold">Estado</label>
                            <input type="text" id="estado" name="estado" value="{{ old('estado') }}" class="form-control form-control-lg text-uppercase" placeholder="SC" maxlength="2" required>
                            @error('estado') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="alert alert-light border mt-4 mb-0">
                        Depois de cadastrada, a cidade fica disponível no formulário de endereço do cliente.
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-dark fw-bold">Salvar cidade</button>
                        <a href="{{ route('cidades.index') }}" class="btn btn-outline-dark fw-bold">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
