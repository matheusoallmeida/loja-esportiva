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
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('produtos.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Item admin</p>
                            <h2 class="h4 fw-black">Produtos</h2>
                            <p class="text-secondary mb-0">Cadastrar, editar e remover produtos da vitrine.</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('categorias.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Item admin</p>
                            <h2 class="h4 fw-black">Categorias</h2>
                            <p class="text-secondary mb-0">Organizar os tipos de produtos exibidos na loja.</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('tamanhos.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Item admin</p>
                            <h2 class="h4 fw-black">Tamanhos</h2>
                            <p class="text-secondary mb-0">Gerenciar opcoes de tamanho dos produtos.</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('cidades.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Item admin</p>
                            <h2 class="h4 fw-black">Cidades</h2>
                            <p class="text-secondary mb-0">Manter cidades usadas nos enderecos dos clientes.</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('users.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Item admin</p>
                            <h2 class="h4 fw-black">Clientes</h2>
                            <p class="text-secondary mb-0">Consultar e atualizar usuarios clientes.</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('vendas.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Item admin</p>
                            <h2 class="h4 fw-black">Vendas</h2>
                            <p class="text-secondary mb-0">Acompanhar pedidos e status de compra.</p>
                        </a>
                    </div>
                </div>
            @else
                <div class="row g-4">
                    <div class="col-md-6">
                        <a href="{{ url('/') }}#produtos" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Cliente</p>
                            <h2 class="h4 fw-black">Comprar produtos</h2>
                            <p class="text-secondary mb-0">Volte para a vitrine e escolha os produtos da loja.</p>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('carrinhos.index') }}" class="admin-card border rounded p-4 h-100 d-block text-decoration-none text-dark">
                            <p class="text-secondary small text-uppercase fw-bold letter-spaced mb-2">Cliente</p>
                            <h2 class="h4 fw-black">Carrinho</h2>
                            <p class="text-secondary mb-0">Revise sua sacola e finalize a compra.</p>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
