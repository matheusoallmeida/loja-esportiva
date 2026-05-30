<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Estoque</p>
            <h1 class="h3 fw-black mb-0">Novo tamanho</h1>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container">
            <div class="admin-panel admin-form-panel mx-auto">
                <form method="POST" action="{{ route('tamanhos.store') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="sigla" class="form-label fw-bold">Sigla</label>
                            <input type="text" id="sigla" name="sigla" value="{{ old('sigla') }}" class="form-control form-control-lg text-uppercase" placeholder="P" maxlength="10" required>
                            @error('sigla') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-8">
                            <label for="descricao" class="form-label fw-bold">Descrição</label>
                            <input type="text" id="descricao" name="descricao" value="{{ old('descricao') }}" class="form-control form-control-lg" placeholder="Pequeno" required>
                            @error('descricao') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-dark fw-bold">Salvar tamanho</button>
                        <a href="{{ route('tamanhos.index') }}" class="btn btn-outline-dark fw-bold">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
