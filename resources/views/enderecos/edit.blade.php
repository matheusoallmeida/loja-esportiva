<x-app-layout>
    <x-slot name="header">
        <h1 class="h2 fw-black mb-0">Editar endereço</h1>
    </x-slot>

    <section class="py-5">
        <div class="container">
            <div class="bg-white border rounded p-4 p-lg-5">
                <a href="{{ route('enderecos.index') }}" class="btn btn-outline-dark fw-bold mb-4">Voltar</a>

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('enderecos.update', $endereco->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @if(auth()->user()->role === 'cliente')
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    @else
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Cliente</label>
                            <select name="user_id" class="form-select form-select-lg" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $endereco->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Descrição</label>
                            <input type="text" name="descricao" value="{{ old('descricao', $endereco->descricao) }}" class="form-control form-control-lg" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Cidade</label>
                            <select name="cidade_id" class="form-select form-select-lg" required>
                                @foreach($cidades as $cidade)
                                    <option value="{{ $cidade->id }}" {{ $endereco->cidade_id == $cidade->id ? 'selected' : '' }}>
                                        {{ $cidade->nome }} - {{ $cidade->estado }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Logradouro</label>
                            <input type="text" name="logradouro" value="{{ old('logradouro', $endereco->logradouro) }}" class="form-control form-control-lg" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Número</label>
                            <input type="text" name="numero" value="{{ old('numero', $endereco->numero) }}" class="form-control form-control-lg" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Bairro</label>
                            <input type="text" name="bairro" value="{{ old('bairro', $endereco->bairro) }}" class="form-control form-control-lg" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">CEP</label>
                            <input type="text" name="cep" value="{{ old('cep', $endereco->cep) }}" class="form-control form-control-lg" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark btn-lg fw-bold mt-4">Salvar alterações</button>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
