<!-- TOP BAR -->
<div class="bg-black text-white text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-end items-center py-2 gap-4">

            <a href="/acompanhar-pedido" class="hover:text-gray-300">
                Acompanhe seu pedido
            </a>

            <span class="text-gray-500">|</span>

            <a href="/carrinho" class="hover:text-gray-300">
                Carrinho
            </a>

            <span class="text-gray-500">|</span>

            <a href="/ajuda" class="hover:text-gray-300">
                Ajuda
            </a>

            <span class="text-gray-500">|</span>

            @auth
                <a href="/dashboard" class="hover:text-gray-300">
                    👤 {{ Auth::user()->name }}
                </a>
            @else
                <a href="/login" class="hover:text-gray-300">
                    Entrar
                </a>
            @endauth

        </div>

    </div>
</div>

<!-- NAVBAR -->
<nav x-data="{ open: false, search: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- LOGO -->
            <div class="flex items-center">
                <a href="/" class="shrink-0 flex items-center">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- MENU DESKTOP -->
            <div class="hidden sm:flex sm:items-center sm:space-x-8">

                <x-nav-link href="/lancamentos" :active="request()->is('lancamentos')">Lançamentos</x-nav-link>
                <x-nav-link href="/masculino" :active="request()->is('masculino')">Masculino</x-nav-link>
                <x-nav-link href="/feminino" :active="request()->is('feminino')">Feminino</x-nav-link>
                <x-nav-link href="/infantil" :active="request()->is('infantil')">Infantil</x-nav-link>
                <x-nav-link href="/personalizado" :active="request()->is('personalizado')">Personalizado</x-nav-link>
                <x-nav-link href="/colecoes" :active="request()->is('colecoes')">Coleções</x-nav-link>
                <x-nav-link href="/ofertas" :active="request()->is('ofertas')">Ofertas</x-nav-link>

            </div>

            <!-- LUPA -->
            <div class="hidden sm:flex sm:items-center relative">

                <!-- BOTÃO -->
                <button @click="search = true" class="text-gray-700 hover:text-black text-lg">
                    🔍
                </button>

                <!-- OVERLAY BUSCA (NIKE STYLE) -->
                <div 
                    x-show="search"
                    x-transition
                    @click.away="search = false"
                    class="fixed inset-0 bg-white z-50 flex flex-col"
                >

                    <!-- SEARCH BAR -->
                    <div class="p-6 flex justify-center">

                        <input 
                            type="text"
                            placeholder="Buscar produtos..."
                            class="w-full max-w-2xl rounded-full border border-gray-300 px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-black"
                            autofocus
                        >

                    </div>

                    <!-- TERMOS -->
                    <div class="px-6 max-w-2xl mx-auto w-full">

                        <h3 class="text-sm text-gray-500 mb-3">
                            Termos mais pesquisados
                        </h3>

                        <div class="flex flex-wrap gap-2">

                            <a href="/buscar?q=camiseta" class="px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-gray-200">camiseta</a>
                            <a href="/buscar?q=nike" class="px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-gray-200">nike</a>
                            <a href="/buscar?q=adidas" class="px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-gray-200">adidas</a>
                            <a href="/buscar?q=ofertas" class="px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-gray-200">ofertas</a>

                        </div>

                    </div>

                    <!-- CANCELAR -->
                    <div class="mt-auto p-6 flex justify-center">

                        <button 
                            @click="search = false"
                            class="text-gray-500 hover:text-black"
                        >
                            Cancelar
                        </button>

                    </div>

                </div>

            </div>

            <!-- HAMBURGUER -->
            <div class="sm:hidden flex items-center">

                <button @click="open = !open" class="text-2xl">
                    ☰
                </button>

            </div>

        </div>
    </div>

    <!-- MOBILE -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t">

        <div class="px-4 py-2 space-y-2">

            <x-responsive-nav-link href="/lancamentos">Lançamentos</x-responsive-nav-link>
            <x-responsive-nav-link href="/masculino">Masculino</x-responsive-nav-link>
            <x-responsive-nav-link href="/feminino">Feminino</x-responsive-nav-link>
            <x-responsive-nav-link href="/infantil">Infantil</x-responsive-nav-link>
            <x-responsive-nav-link href="/personalizado">Personalizado</x-responsive-nav-link>
            <x-responsive-nav-link href="/colecoes">Coleções</x-responsive-nav-link>
            <x-responsive-nav-link href="/ofertas">Ofertas</x-responsive-nav-link>

        </div>

    </div>

</nav>