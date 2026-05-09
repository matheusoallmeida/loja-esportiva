<!-- TOP BAR -->
<div class="bg-black text-white text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-end items-center py-2">

            <div class="flex items-center gap-4">

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
                        {{ Auth::user()->name }}
                    </a>
                @else
                    <a href="/login" class="hover:text-gray-300">
                        Entrar
                    </a>
                @endauth

            </div>

        </div>

    </div>
</div>






<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LOGO -->
            <div class="flex items-center">
                <a href="/" class="shrink-0 flex items-center" >
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- MENU DESKTOP -->
            <div class="hidden sm:flex sm:items-center sm:space-x-8">

                <x-nav-link href="/lancamentos" :active="request()->is('lancamentos')">
                    Lançamentos
                </x-nav-link>

                <x-nav-link href="/masculino" :active="request()->is('masculino')">
                    Masculino
                </x-nav-link>

                <x-nav-link href="/feminino" :active="request()->is('feminino')">
                    Feminino
                </x-nav-link>

                <x-nav-link href="/infantil" :active="request()->is('infantil')">
                    Infantil
                </x-nav-link>

                <x-nav-link href="/personalizado" :active="request()->is('personalizado')">
                    Personalizado
                </x-nav-link>

                <x-nav-link href="/colecoes" :active="request()->is('colecoes')">
                    Coleções
                </x-nav-link>

                <x-nav-link href="/ofertas" :active="request()->is('ofertas')">
                    Ofertas
                </x-nav-link>

            </div>

            <!-- USUÁRIO -->
            <div class="hidden sm:flex sm:items-center">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm text-gray-500">
                            <div>{{ Auth::user()->name ?? 'Usuário' }}</div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

            </div>

            <!-- HAMBURGUER -->
            <div class="sm:hidden flex items-center">
                <button @click="open = ! open">
                    ☰
                </button>
            </div>

        </div>
    </div>

    <!-- MENU MOBILE -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t">

        <div class="px-4 py-2 space-y-2">

            <x-responsive-nav-link href="/lancamentos">
                Lançamentos
            </x-responsive-nav-link>

            <x-responsive-nav-link href="/masculino">
                Masculino
            </x-responsive-nav-link>

            <x-responsive-nav-link href="/feminino">
                Feminino
            </x-responsive-nav-link>

            <x-responsive-nav-link href="/infantil">
                Infantil
            </x-responsive-nav-link>

            <x-responsive-nav-link href="/personalizado">
                Personalizado
            </x-responsive-nav-link>

            <x-responsive-nav-link href="/colecoes">
                Coleções
            </x-responsive-nav-link>

            <x-responsive-nav-link href="/ofertas">
                Ofertas
            </x-responsive-nav-link>

        </div>

    </div>

</nav>