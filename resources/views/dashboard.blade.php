<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-1">
                    {{ auth()->user()->role === 'admin' ? 'Administração' : 'Cliente' }}
                </p>
                <h1 class="h3 fw-black mb-0">
                    {{ auth()->user()->role === 'admin' ? 'Painel administrativo' : 'Minha conta' }}
                </h1>
            </div>

            <a href="{{ url('/') }}" class="btn btn-outline-dark fw-bold">Ver loja</a>
        </div>
    </x-slot>

    <section class="admin-page py-5">
        <div class="container">
            @if(auth()->user()->role === 'admin')
                <div class="admin-hero mb-4">
                    <div>
                        <p class="text-uppercase small fw-bold text-white-50 mb-2">MANTRA</p>
                        <h2 class="display-6 fw-black mb-2">Gerencie a vitrine da loja</h2>
                        <p class="mb-0 text-white-50">Cadastre produtos, categorias, fotos, tamanhos e cidades atendidas.</p>
                    </div>
                    <a href="{{ route('produtos.create') }}" class="btn btn-light fw-bold">Adicionar produto</a>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6 col-xl-3">
                        <a href="{{ route('categorias.create') }}" class="admin-action d-block text-decoration-none h-100">
                            <span>01</span>
                            <h3>Adicionar categoria</h3>
                            <p>Crie categorias principais e subcategorias para organizar o menu.</p>
                        </a>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <a href="{{ route('produtos.create') }}" class="admin-action d-block text-decoration-none h-100">
                            <span>02</span>
                            <h3>Adicionar produto</h3>
                            <p>Cadastre nome, descrição, preço, estoque, categoria e tamanho.</p>
                        </a>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <a href="{{ route('produtos.create') }}#foto-produto" class="admin-action d-block text-decoration-none h-100">
                            <span>03</span>
                            <h3>Adicionar foto</h3>
                            <p>Envie a imagem do produto para aparecer na vitrine e no detalhe.</p>
                        </a>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <a href="{{ route('tamanhos.create') }}" class="admin-action d-block text-decoration-none h-100">
                            <span>04</span>
                            <h3>Adicionar tamanho</h3>
                            <p>Cadastre siglas como P, M, G, GG e descrições completas.</p>
                        </a>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <a href="{{ route('cidades.create') }}" class="admin-action d-block text-decoration-none h-100">
                            <span>05</span>
                            <h3>Adicionar cidade</h3>
                            <p>Defina as cidades em que a loja faz entrega.</p>
                        </a>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('categorias.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Catálogo</p>
                            <h2 class="h4 fw-black">Categorias</h2>
                            <p class="text-secondary mb-0">Listar, editar e remover categorias.</p>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('produtos.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Catálogo</p>
                            <h2 class="h4 fw-black">Produtos e fotos</h2>
                            <p class="text-secondary mb-0">Gerenciar produtos cadastrados e suas imagens.</p>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('tamanhos.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Estoque</p>
                            <h2 class="h4 fw-black">Tamanhos</h2>
                            <p class="text-secondary mb-0">Listar e editar tamanhos disponíveis.</p>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('cidades.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Entrega</p>
                            <h2 class="h4 fw-black">Cidades</h2>
                            <p class="text-secondary mb-0">Listar cidades atendidas pela loja.</p>
                        </a>
                    </div>
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
