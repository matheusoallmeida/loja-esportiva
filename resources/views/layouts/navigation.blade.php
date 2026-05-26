{{-- ========================= --}}
{{-- TOP BAR SUPERIOR --}}
{{-- ========================= --}}
<div class="bg-dark text-white py-2">

    {{-- Container Bootstrap --}}
    <div class="container">

        {{-- Links alinhados à direita --}}
        <div class="d-flex justify-content-end align-items-center gap-3 small">

            <a href="/acompanhar-pedido" class="text-white text-decoration-none">
                Acompanhe seu pedido
            </a>

            <span>|</span>

            <a href="/carrinho" class="text-white text-decoration-none">
                Carrinho
            </a>

            <span>|</span>

            <a href="/ajuda" class="text-white text-decoration-none">
                Ajuda
            </a>

            <span>|</span>

           @auth

    {{-- USUÁRIO --}}
    <a href="/dashboard" class="nav-link">

        👤 {{ Auth::user()->name }}

    </a>

    {{-- PAINEL ADMIN (SIMULAÇÃO) --}}
    <a href="/admin/produtos" class="nav-link">

        Painel Admin

    </a>

@endauth

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- NAVBAR PRINCIPAL --}}
{{-- ========================= --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">

    <div class="container">

        {{-- LOGO --}}
        <a class="navbar-brand" href="/">
            <x-application-logo style="height: 40px;" />
        </a>

        {{-- BOTÃO MOBILE --}}
        <button 
            class="navbar-toggler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarMenu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- MENU --}}
        <div class="collapse navbar-collapse" id="navbarMenu">

            {{-- Links da navbar --}}
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="/categoria/lancamentos">
                        Lançamentos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/categoria/masculino">
                        Masculino
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/categoria/feminino">
                        Feminino
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/infantil">
                        Infantil
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/personalizado">
                        Personalizado
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/colecoes">
                        Coleções
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-danger fw-bold" href="/ofertas">
                        Ofertas
                    </a>
                </li>

            </ul>

            {{-- FORMULÁRIO DE BUSCA --}}
            <form class="d-flex" action="/buscar" method="GET">

                <input 
                    class="form-control me-2"
                    type="search"
                    name="q"
                    placeholder="Buscar produtos..."
                >

                <button class="btn btn-dark" type="submit">
                    Buscar
                </button>

                <a href="/enderecos" class="nav-link">
                   Meus Endereços
                </a>
                <a href="/minhas-compras" class="nav-link">
                    Minhas Compras
                    </a>

            </form>

        </div>

    </div>

</nav>