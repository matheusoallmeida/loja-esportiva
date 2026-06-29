<section>
    <header class="mb-4">
        <p class="text-uppercase small fw-bold letter-spaced text-secondary mb-2">Segurança</p>
        <h2 class="h4 fw-black mb-1">Alterar senha</h2>
        <p class="text-secondary mb-0">Use uma senha forte para proteger sua conta.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label fw-semibold">Senha atual</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control form-control-lg" autocomplete="current-password">
            @foreach($errors->updatePassword->get('current_password') as $message)
                <div class="text-danger small mt-2">{{ $message }}</div>
            @endforeach
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="update_password_password" class="form-label fw-semibold">Nova senha</label>
                <input id="update_password_password" name="password" type="password" class="form-control form-control-lg" autocomplete="new-password">
                @foreach($errors->updatePassword->get('password') as $message)
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @endforeach
            </div>

            <div class="col-md-6">
                <label for="update_password_password_confirmation" class="form-label fw-semibold">Confirmar senha</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control form-control-lg" autocomplete="new-password">
                @foreach($errors->updatePassword->get('password_confirmation') as $message)
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @endforeach
            </div>
        </div>

        <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3 mt-4">
            <button type="submit" class="btn btn-dark btn-lg fw-bold">Atualizar senha</button>

            @if (session('status') === 'password-updated')
                <span class="text-success fw-semibold">Senha atualizada.</span>
            @endif
        </div>
    </form>
</section>
