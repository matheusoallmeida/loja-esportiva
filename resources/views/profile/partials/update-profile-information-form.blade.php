<section>
    <header class="mb-4">
        <p class="text-uppercase small fw-bold letter-spaced text-secondary mb-2">Dados pessoais</p>
        <h2 class="h4 fw-black mb-1">Informações do perfil</h2>
        <p class="text-secondary mb-0">Atualize seus dados de acesso e identificação.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Nome</label>
            <input id="name" name="name" type="text" class="form-control form-control-lg" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @foreach($errors->get('name') as $message)
                <div class="text-danger small mt-2">{{ $message }}</div>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input id="email" name="email" type="email" class="form-control form-control-lg" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @foreach($errors->get('email') as $message)
                <div class="text-danger small mt-2">{{ $message }}</div>
            @endforeach

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-3 mb-0">
                    Seu email ainda não foi verificado.
                    <button form="send-verification" class="btn btn-link p-0 align-baseline text-dark fw-bold">
                        Reenviar verificação
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="alert alert-success mt-3 mb-0">
                        Um novo link de verificação foi enviado para seu email.
                    </div>
                @endif
            @endif
        </div>

        <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3 mt-4">
            <button type="submit" class="btn btn-dark btn-lg fw-bold">Salvar alterações</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success fw-semibold">Perfil salvo.</span>
            @endif
        </div>
    </form>
</section>
