<div class="top-strip bg-white border-bottom d-none d-lg-block">
    <div class="container-fluid px-5">
        <div class="d-flex justify-content-end gap-4 small py-2">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('dashboard') }}" class="text-dark text-decoration-none">Painel</a>
                    <a href="{{ route('categorias.index') }}" class="text-dark text-decoration-none">Categorias</a>
                    <a href="{{ route('produtos.index') }}" class="text-dark text-decoration-none">Produtos e fotos</a>
                    <a href="{{ route('tamanhos.index') }}" class="text-dark text-decoration-none">Tamanhos</a>
                    <a href="{{ route('cidades.index') }}" class="text-dark text-decoration-none">Cidades</a>
                @else
                    <a href="{{ route('profile.edit') }}" class="text-dark text-decoration-none">Meu cadastro</a>
                    <a href="{{ route('enderecos.index') }}" class="text-dark text-decoration-none">Endereços</a>
                    <a href="{{ route('vendas.index') }}" class="text-dark text-decoration-none">Pedidos</a>
                @endif
            @else
                <a href="{{ route('register') }}" class="text-dark text-decoration-none">Junte-se a nós</a>
                <a href="{{ route('login') }}" class="text-dark text-decoration-none">Entrar</a>
            @endauth
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top main-navbar">
    <div class="container-fluid px-4 px-lg-5">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-black" href="{{ url('/') }}">
            <span class="brand-logo-frame">
                <img src="{{ asset('images/site/logo-mantra-certo.png') }}" alt="Mantra" class="brand-logo-img">
            </span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Abrir menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav mx-lg-auto mb-2 mb-lg-0 gap-lg-5">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') && !request('categoria') ? 'active fw-bold' : '' }}" href="{{ url('/') }}">
                        Lançamentos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('categoria') === 'masculino' ? 'active fw-bold' : '' }}" href="{{ url('/') }}?categoria=masculino#produtos">
                        Masculino
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('categoria') === 'feminino' ? 'active fw-bold' : '' }}" href="{{ url('/') }}?categoria=feminino#produtos">
                        Feminino
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('categoria') === 'infantil' ? 'active fw-bold' : '' }}" href="{{ url('/') }}?categoria=infantil#produtos">
                        Infantil
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-3">
                <form class="search-pill d-none d-md-flex align-items-center" action="{{ url('/') }}" method="GET">
                    <span class="search-icon">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="search" name="buscar" class="form-control border-0 bg-transparent shadow-none" placeholder="Buscar" aria-label="Buscar">
                </form>

                @auth
                    @if(auth()->user()->role === 'cliente')
                        <a href="{{ route('carrinhos.index') }}" class="nav-icon-link" aria-label="Carrinho">▢</a>
                    @endif

                    <a href="{{ route('profile.edit') }}" class="btn btn-link text-dark text-decoration-none p-0 fw-semibold">
                        {{ Auth::user()->name }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button class="btn btn-outline-dark btn-sm fw-bold" type="submit">Sair</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-icon-link" aria-label="Favoritos">
                        <i class="bi bi-heart"></i>
                    </a>

                    <a href="{{ route('login') }}" class="nav-icon-link" aria-label="Carrinho">
                        <i class="bi bi-cart3"></i>
                    </a>

                    <a href="{{ route('login') }}" class="nav-icon-link" aria-label="Login">
                        <i class="bi bi-person-circle"></i>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
