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
                                    <option value="{{ $user->id }}" {{ $endereco->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <input type="hidden" name="cidade_id" id="cidade_id_hidden" value="{{ old('cidade_id', $endereco->cidade_id) }}">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Descrição</label>
                            <input type="text" name="descricao" value="{{ old('descricao', $endereco->descricao) }}" class="form-control form-control-lg" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">CEP</label>
                            <input type="text" name="cep" id="cep" value="{{ old('cep', $endereco->cep) }}" class="form-control form-control-lg" maxlength="9" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Número</label>
                            <input type="text" name="numero" value="{{ old('numero', $endereco->numero) }}" class="form-control form-control-lg" required>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Logradouro</label>
                            <input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro', $endereco->logradouro) }}" class="form-control form-control-lg bg-light" readonly required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Bairro</label>
                            <input type="text" name="bairro" id="bairro" value="{{ old('bairro', $endereco->bairro) }}" class="form-control form-control-lg bg-light" readonly required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Cidade</label>
                            <select id="cidade_id_visual" class="form-select form-select-lg bg-light" disabled required>
                                <option value="">Informe o CEP</option>
                                @foreach($cidades as $cidade)
                                    <option value="{{ $cidade->id }}"
                                        data-nome="{{ mb_strtolower($cidade->nome) }}"
                                        data-estado="{{ mb_strtoupper($cidade->estado) }}"
                                        {{ old('cidade_id', $endereco->cidade_id) == $cidade->id ? 'selected' : '' }}>
                                        {{ $cidade->nome }} - {{ $cidade->estado }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark btn-lg fw-bold mt-4">Salvar alterações</button>
                </form>
            </div>
        </div>
    </section>

    <script>
        const cepInput = document.getElementById('cep');

        cepInput.addEventListener('input', function () {
            let cep = this.value.replace(/\D/g, '');

            if (cep.length > 5) {
                cep = cep.replace(/^(\d{5})(\d)/, '$1-$2');
            }

            this.value = cep;
        });

        cepInput.addEventListener('blur', buscarCep);

        function buscarCep() {
            let cep = cepInput.value.replace(/\D/g, '');

            if (cep.length !== 8) {
                return;
            }

            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (data.erro) {
                        alert('CEP não encontrado.');
                        limparEndereco();
                        return;
                    }

                    document.getElementById('logradouro').value = data.logradouro || '';
                    document.getElementById('bairro').value = data.bairro || '';

                    selecionarCidade(data.localidade, data.uf);
                })
                .catch(() => {
                    alert('Erro ao consultar o CEP.');
                });
        }

        function selecionarCidade(nomeCidade, uf) {
            const cidadeVisual = document.getElementById('cidade_id_visual');
            const cidadeHidden = document.getElementById('cidade_id_hidden');

            const cidadeViaCep = (nomeCidade || '').toLowerCase();
            const ufViaCep = (uf || '').toUpperCase();

            cidadeHidden.value = '';
            cidadeVisual.value = '';

            for (let option of cidadeVisual.options) {
                if (
                    option.dataset.nome === cidadeViaCep &&
                    option.dataset.estado === ufViaCep
                ) {
                    cidadeVisual.value = option.value;
                    cidadeHidden.value = option.value;
                    return;
                }
            }

            alert('Cidade retornada pelo CEP não está cadastrada no sistema.');
        }

        function limparEndereco() {
            document.getElementById('logradouro').value = '';
            document.getElementById('bairro').value = '';
            document.getElementById('cidade_id_visual').value = '';
            document.getElementById('cidade_id_hidden').value = '';
        }
    </script>
</x-app-layout>