<div class="top-strip bg-white border-bottom d-none d-lg-block">
    <div class="container-fluid px-5">
        <div class="d-flex justify-content-end gap-4 small py-2">
            <a href="#" class="text-dark text-decoration-none">Ajuda</a>
            @auth
                @if(auth()->user()->role === 'cliente')
                    <a href="{{ route('vendas.index') }}" class="text-dark text-decoration-none">Pedidos</a>
                @else
                    <a href="{{ route('dashboard') }}" class="text-dark text-decoration-none">Admin</a>
                @endif
            @else
                <a href="{{ route('register') }}" class="text-dark text-decoration-none">Junte-se a nos</a>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="text-dark text-decoration-none">Entrar</a>
            @endguest
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top main-navbar">
    <div class="container-fluid px-4 px-lg-5">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-black" href="/">
            <span class="brand-logo-frame">
                <img src="{{ asset('images/site/logo-mantra-certo.png') }}" alt="Mantra" class="brand-logo-img">
            </span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Abrir menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav mx-lg-auto mb-2 mb-lg-0 gap-lg-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active fw-bold' : '' }}" href="/">Lançamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}#produtos">Masculino</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}#produtos">Feminino</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}#produtos">Infantil</a>
                </li>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('produtos.*') || request()->routeIs('categorias.*') || request()->routeIs('tamanhos.*') ? 'active fw-bold' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Painel</a></li>
                                <li><a class="dropdown-item" href="{{ route('produtos.index') }}">Produtos</a></li>
                                <li><a class="dropdown-item" href="{{ route('categorias.index') }}">Categorias</a></li>
                                <li><a class="dropdown-item" href="{{ route('tamanhos.index') }}">Tamanhos</a></li>
                                <li><a class="dropdown-item" href="{{ route('cidades.index') }}">Cidades</a></li>
                                <li><a class="dropdown-item" href="{{ route('users.index') }}">Clientes</a></li>
                                <li><a class="dropdown-item" href="{{ route('vendas.index') }}">Vendas</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item d-lg-none">
                            <a class="nav-link {{ request()->routeIs('vendas.*') ? 'active fw-bold' : '' }}" href="{{ route('vendas.index') }}">Pedidos</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <div class="d-flex align-items-center gap-3">
                <form class="search-pill d-none d-md-flex align-items-center" action="{{ url('/') }}" method="GET">
                    <span class="search-icon">⌕</span>
                    <input type="search" class="form-control border-0 bg-transparent shadow-none" placeholder="Buscar" aria-label="Buscar">
                </form>

                @auth
                    @if(auth()->user()->role === 'cliente')
                        <a href="{{ route('carrinhos.index') }}" class="nav-icon-link" aria-label="Carrinho">▢</a>
                    @endif

                    <div class="dropdown">
                        <button class="btn btn-link text-dark text-decoration-none p-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Sair</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="nav-icon-link" aria-label="Favoritos">♡</a>
                    <a href="{{ route('login') }}" class="nav-icon-link" aria-label="Carrinho">▢</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
