<x-guest-layout>
    <div class="mb-4">
        <p class="text-success fw-bold text-uppercase small letter-spaced mb-2">Cadastro</p>
        <h1 class="h3 fw-black mb-1">Crie sua conta cliente</h1>
        <p class="text-secondary mb-0">Use seu cadastro para comprar e acompanhar pedidos.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Nome</label>
            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="cpf" class="form-label fw-semibold">CPF</label>
                <input id="cpf" class="form-control" type="text" name="cpf" value="{{ old('cpf') }}" required>
            </div>
            <div class="col-md-6">
                <label for="data_nascimento" class="form-label fw-semibold">Data de nascimento</label>
                <input id="data_nascimento" class="form-control" type="date" name="data_nascimento" value="{{ old('data_nascimento') }}">
            </div>
        </div>

        <div class="mb-3 mt-3">
            <label for="telefone" class="form-label fw-semibold">Telefone</label>
            <input id="telefone" class="form-control" type="text" name="telefone" value="{{ old('telefone') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="password" class="form-label fw-semibold">Senha</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
            </div>
            <div class="col-md-6">
                <label for="password_confirmation" class="form-label fw-semibold">Confirmar senha</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <button type="submit" class="btn btn-dark btn-lg w-100 fw-bold mt-4">
            Registrar
        </button>

        <p class="text-center text-secondary mt-4 mb-0">
            Ja possui cadastro?
            <a href="{{ route('login') }}" class="text-dark fw-bold">Entrar</a>
        </p>
    </form>
</x-guest-layout>
