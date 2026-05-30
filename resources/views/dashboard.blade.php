<x-app-layout>
    <x-slot name="header">
        <h1 class="h3 fw-black mb-0">
            {{ auth()->user()->role === 'admin' ? 'Painel administrativo' : 'Minha conta' }}
        </h1>
    </x-slot>

    <section class="py-5">
        <div class="container">
            @if(auth()->user()->role === 'admin')
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('categorias.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Admin</p>
                            <h2 class="h4 fw-black">Categorias</h2>
                            <p class="text-secondary mb-0">Cadastrar categorias e subcategorias de produtos.</p>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('produtos.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Admin</p>
                            <h2 class="h4 fw-black">Produtos e fotos</h2>
                            <p class="text-secondary mb-0">Cadastrar produtos, estoque, tamanhos e imagens.</p>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('cidades.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Admin</p>
                            <h2 class="h4 fw-black">Cidades</h2>
                            <p class="text-secondary mb-0">Manter as cidades atendidas pela loja.</p>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('tamanhos.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Admin</p>
                            <h2 class="h4 fw-black">Tamanhos</h2>
                            <p class="text-secondary mb-0">Cadastrar siglas e descrições dos tamanhos.</p>
                        </a>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <a href="{{ route('produtos.create') }}" class="btn btn-dark fw-bold">Novo produto</a>
                    <a href="{{ url('/') }}#produtos" class="btn btn-outline-dark fw-bold">Ver vitrine</a>
                </div>
            @else
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('profile.edit') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Cliente</p>
                            <h2 class="h4 fw-black">Meu cadastro</h2>
                            <p class="text-secondary mb-0">Atualize nome, email, senha e dados da sua conta.</p>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('enderecos.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Cliente</p>
                            <h2 class="h4 fw-black">Endereços</h2>
                            <p class="text-secondary mb-0">Cadastre locais de entrega na cidade atendida.</p>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('carrinhos.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Cliente</p>
                            <h2 class="h4 fw-black">Carrinho</h2>
                            <p class="text-secondary mb-0">Revise sua sacola e finalize a compra.</p>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('vendas.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Cliente</p>
                            <h2 class="h4 fw-black">Minhas compras</h2>
                            <p class="text-secondary mb-0">Acompanhe suas vendas e pedidos fechados.</p>
                        </a>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ url('/') }}#produtos" class="btn btn-dark fw-bold">Continuar comprando</a>
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
