<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">Clientes</p>
                <h1 class="h3 fw-black mb-0">Editar cliente</h1>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('users.show', $cliente->id) }}" class="btn btn-outline-dark fw-bold">Ver detalhes</a>
                <a href="{{ route('users.index') }}" class="btn btn-dark fw-bold">Voltar</a>
            </div>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <aside class="admin-panel h-100">
                        <div class="customer-avatar mb-3">
                            {{ strtoupper(substr($cliente->name, 0, 1)) }}
                        </div>

                        <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Cliente #{{ $cliente->id }}</p>
                        <h2 class="h4 fw-black mb-1">{{ $cliente->name }}</h2>
                        <p class="text-secondary mb-4">{{ $cliente->email }}</p>

                        <div class="customer-status">
                            <span>Edicao</span>
                            <strong>Dados cadastrais</strong>
                        </div>
                    </aside>
                </div>

                <div class="col-lg-8">
                    <div class="admin-panel h-100">
                        <div class="mb-4">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Cadastro</p>
                            <h2 class="h4 fw-black mb-1">Atualizar informações</h2>
                            <p class="text-secondary mb-0">Revise os dados do cliente antes de salvar as alterações.</p>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <strong>Revise os campos abaixo.</strong>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('users.update', $cliente->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Nome</label>
                                    <input type="text" name="name" value="{{ old('name', $cliente->name) }}" class="form-control form-control-lg @error('name') is-invalid @enderror" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $cliente->email) }}" class="form-control form-control-lg @error('email') is-invalid @enderror" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">CPF</label>
                                    <input type="text" name="cpf" value="{{ old('cpf', $cliente->cpf) }}" class="form-control form-control-lg @error('cpf') is-invalid @enderror" required>
                                    @error('cpf')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Data de nascimento</label>
                                    <input type="date" name="data_nascimento" value="{{ old('data_nascimento', optional($cliente->data_nascimento)->format('Y-m-d')) }}" class="form-control form-control-lg @error('data_nascimento') is-invalid @enderror">
                                    @error('data_nascimento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Telefone</label>
                                    <input type="text" name="telefone" value="{{ old('telefone', $cliente->telefone) }}" class="form-control form-control-lg @error('telefone') is-invalid @enderror" required>
                                    @error('telefone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('users.index') }}" class="btn btn-outline-dark fw-bold">Cancelar</a>
                                <button type="submit" class="btn btn-dark fw-bold">Salvar alterações</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
