<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <p class="text-uppercase small fw-bold letter-spaced text-secondary mb-2">Conta</p>
                <h1 class="h2 fw-black mb-0">Meu perfil</h1>
            </div>
            <a href="{{ auth()->user()->role === 'admin' ? route('dashboard') : url('/') }}" class="btn btn-outline-dark fw-bold">
                Voltar
            </a>
        </div>
    </x-slot>

    <section class="profile-page py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <aside class="profile-summary bg-white border rounded p-4">
                        <div class="profile-avatar mb-3">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <h2 class="h4 fw-black mb-1">{{ auth()->user()->name }}</h2>
                        <p class="text-secondary mb-3">{{ auth()->user()->email }}</p>

                        <span class="badge rounded-pill text-bg-dark px-3 py-2">
                            {{ auth()->user()->role === 'admin' ? 'Administrador' : 'Cliente' }}
                        </span>

                        <hr class="my-4">

                        <div class="d-grid gap-2">
                            @if(auth()->user()->role === 'cliente')
                                <a href="{{ route('carrinhos.index') }}" class="btn btn-dark fw-bold">Ver carrinho</a>
                                <a href="{{ route('enderecos.index') }}" class="btn btn-outline-dark fw-bold">Meus endereços</a>
                                <a href="{{ route('vendas.index') }}" class="btn btn-outline-dark fw-bold">Minhas compras</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="btn btn-dark fw-bold">Painel admin</a>
                            @endif
                        </div>
                    </aside>
                </div>

                <div class="col-lg-8">
                    <div class="vstack gap-4">
                        <div class="profile-card bg-white border rounded p-4 p-lg-5">
                            @include('profile.partials.update-profile-information-form')
                        </div>

                        <div class="profile-card bg-white border rounded p-4 p-lg-5">
                            @include('profile.partials.update-password-form')
                        </div>

                        <div class="profile-card profile-danger bg-white border rounded p-4 p-lg-5">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
