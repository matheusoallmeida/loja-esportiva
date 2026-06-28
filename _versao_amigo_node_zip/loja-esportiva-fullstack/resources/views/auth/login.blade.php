<x-guest-layout>
    <div class="mb-4">
        <p class="text-success fw-bold text-uppercase small letter-spaced mb-2">Login</p>
        <h1 class="h3 fw-black mb-1">Entre na sua conta</h1>
        <p class="text-secondary mb-0">Acesse o carrinho e finalize suas compras.</p>
    </div>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input id="email" class="form-control form-control-lg" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Senha</label>
            <input id="password" class="form-control form-control-lg" type="password" name="password" required autocomplete="current-password">
        </div>

        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label">Lembrar acesso</label>
            </div>

            @if (Route::has('password.request'))
                <a class="small text-dark fw-semibold" href="{{ route('password.request') }}">
                    Esqueci a senha
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-dark btn-lg w-100 fw-bold">
            Entrar
        </button>

        <p class="text-center text-secondary mt-4 mb-0">
            Ainda nao tem cadastro?
            <a href="{{ route('register') }}" class="text-dark fw-bold">Criar conta</a>
        </p>
    </form>
</x-guest-layout>
