<section>
    <header class="mb-4">
        <p class="text-uppercase small fw-bold letter-spaced text-danger mb-2">Zona de risco</p>
        <h2 class="h4 fw-black mb-1">Excluir conta</h2>
        <p class="text-secondary mb-0">Depois de excluir sua conta, seus dados serão removidos permanentemente.</p>
    </header>

    <button type="button" class="btn btn-outline-danger fw-bold" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
        Excluir conta
    </button>

    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="post" action="{{ route('profile.destroy') }}" class="modal-content border-0">
                @csrf
                @method('delete')

                <div class="modal-header border-0">
                    <h2 class="modal-title h4 fw-black" id="deleteAccountModalLabel">Confirmar exclusão</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body">
                    <p class="text-secondary">
                        Digite sua senha para confirmar a exclusão permanente da conta.
                    </p>

                    <label for="password" class="form-label fw-semibold">Senha</label>
                    <input id="password" name="password" type="password" class="form-control form-control-lg" placeholder="Digite sua senha">

                    @foreach($errors->userDeletion->get('password') as $message)
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @endforeach
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-dark fw-bold" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger fw-bold">Excluir definitivamente</button>
                </div>
            </form>
        </div>
    </div>
</section>
