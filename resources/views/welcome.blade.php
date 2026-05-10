@extends('layouts.app')

@php

$produtos = [

    [
        'nome' => 'Real Madrid 24/25 Stadium Home',
        'categoria' => 'Masculino',
        'preco' => '299,90',
        'imagem' => 'produto1.jpg',
    ],

    [
        'nome' => 'PSG 24/25 Home',
        'categoria' => 'Feminino',
        'preco' => '279,90',
        'imagem' => 'produto2.jpg',
    ],

    [
        'nome' => 'Brasil Infantil',
        'categoria' => 'Infantil',
        'preco' => '199,90',
        'imagem' => 'produto3.jpg',
    ],

    [
        'nome' => 'Barcelona Home 24/25',
        'categoria' => 'Masculino',
        'preco' => '289,90',
        'imagem' => 'produto4.jpg',
    ],

];

@endphp

@section('content')

<!-- HERO -->
<section class="relative h-[85vh] w-full overflow-hidden">

    <!-- IMAGEM -->
    <img 
        src="{{ asset('img/banner2.1.jpg') }}"
        alt="Banner"
        class="w-full h-full object-cover"
    >

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/40"></div>

    <!-- CONTEÚDO -->
    <div class="absolute inset-0 flex items-center">

        <div class="max-w-xl px-8 md:px-20 text-white">

            <p class="uppercase tracking-[5px] text-sm mb-4 text-gray-200 drop-shadow-lg">
                Nova Coleção 2026
            </p>

            <h1 class="text-5xl md:text-7xl font-black uppercase leading-none mb-6 drop-shadow-2xl">
                Vista Sua<br>Paixão
            </h1>

            <p class="text-lg md:text-xl text-gray-200 leading-relaxed mb-8 drop-shadow-lg">
                Camisas oficiais dos maiores clubes do mundo.
                Estilo, tradição e performance em cada detalhe.
            </p>

            <!-- BOTÕES -->
            <div class="flex flex-wrap gap-4">

                <a 
                    href="/lancamentos"
                    class="bg-white text-black px-8 py-3 rounded-full font-semibold hover:bg-gray-200 transition"
                >
                    Comprar
                </a>

                <a 
                    href="/personalizado"
                    class="border border-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-black transition"
                >
                    Personalizar
                </a>

            </div>

        </div>

    </div>

</section>


<!-- VITRINE -->
<section class="py-16 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- TÍTULO -->
        <div class="flex items-center justify-between mb-10">

            <div>
                <p class="text-sm uppercase tracking-[4px] text-gray-500">
                    Produtos em destaque
                </p>

                <h2 class="text-3xl md:text-5xl font-black mt-2">
                    Mais Vendidos
                </h2>
            </div>

            <a 
                href="/lancamentos"
                class="hidden md:block text-sm font-semibold hover:underline"
            >
                Ver todos
            </a>

        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            @foreach ($produtos as $produto)

            <div class="group">

                <!-- IMAGEM -->
                <div class="bg-gray-100 rounded-3xl overflow-hidden">

                    <img 
                        src="{{ asset('img/' . $produto['imagem']) }}"
                        alt="{{ $produto['nome'] }}"
                        class="w-full h-[350px] object-cover group-hover:scale-105 transition duration-500"
                    >

                </div>

                <!-- INFO -->
                <div class="mt-4">

                    <h3 class="font-semibold text-lg">
                        {{ $produto['nome'] }}
                    </h3>

                    <p class="text-gray-500 text-sm mt-1">
                        {{ $produto['categoria'] }}
                    </p>

                    <!-- PREÇO -->
                    <div class="mt-4">

                        <span class="text-xl font-bold block">
                            R$ {{ $produto['preco'] }}
                        </span>

                        <p class="text-gray-500 text-sm mt-1">
                            Até 6x sem juros
                        </p>

                    </div>

                    <!-- BOTÃO -->
                    <button class="w-full mt-5 bg-black text-white px-4 py-3 rounded-full text-sm hover:bg-gray-800 transition">
                        Comprar
                    </button>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>


<!-- BANNERS -->
<section class="py-10 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- PERSONALIZAR -->
            <div class="relative bg-gray-100 rounded-3xl overflow-hidden min-h-[320px]">

                <!-- TEXTO -->
                <div class="absolute z-10 left-8 top-10 max-w-xs">

                    <h2 class="text-4xl font-black uppercase leading-none mb-4">
                        Personalize<br>do seu jeito
                    </h2>

                    <p class="text-gray-600 mb-6">
                        Adicione nome, número e patches oficiais.
                    </p>

                    <a 
                        href="/personalizado"
                        class="bg-black text-white px-6 py-3 rounded-full text-sm hover:bg-gray-800 transition"
                    >
                        Personalizar Agora
                    </a>

                </div>

                <!-- IMAGEM -->
                <img 
    src="{{ asset('img/banner-personalizar.png') }}"
    alt="Personalizar"
    class="absolute right-[-60px] top-1/2 -translate-y-1/2 w-[55%] object-contain"
>
            </div>

            <!-- PATCHES -->
            <div class="relative bg-gray-100 rounded-3xl overflow-hidden min-h-[320px]">

                <!-- TEXTO -->
                <div class="absolute z-10 left-8 top-10 max-w-xs">

                    <h2 class="text-4xl font-black uppercase leading-none mb-4">
                        Patches<br>Oficiais
                    </h2>

                    <p class="text-gray-600 mb-6">
                        Mostre cada conquista com patches exclusivos.
                    </p>

                    <a 
                        href="/colecoes"
                        class="bg-black text-white px-6 py-3 rounded-full text-sm hover:bg-gray-800 transition"
                    >
                        Ver Patches
                    </a>

                </div>

                <!-- IMAGEM -->
                <img 
                    src="{{ asset('img/banner-patches.png') }}"
                    alt="Patches"
                    class="absolute right-8 bottom-6 w-[50%] object-contain"
                >

            </div>

        </div>

    </div>

</section>

<!-- COLEÇÕES EXCLUSIVAS -->
<section class="py-10 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-black rounded-3xl overflow-hidden p-10">

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 items-center">

                <!-- TEXTO -->
                <div class="text-white">

                    <p class="uppercase tracking-[4px] text-sm text-gray-400 mb-3">
                        Exclusivo
                    </p>

                    <h2 class="text-5xl font-black leading-none mb-5">
                        Coleções<br>Exclusivas
                    </h2>

                    <p class="text-gray-300 mb-8">
                        Estilos únicos para torcedores
                        que vivem o jogo.
                    </p>

                    <a 
                        href="/colecoes"
                        class="inline-block bg-white text-black px-7 py-3 rounded-full font-semibold hover:bg-gray-200 transition"
                    >
                        Ver Coleções
                    </a>

                </div>

                <!-- CARD -->
                <div class="relative rounded-2xl overflow-hidden h-[320px] group border border-white/10">

                    <img 
                        src="{{ asset('img/colecao1.jpg') }}"
                        alt="Coleção"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700"
                    >

                    <div class="absolute inset-0 bg-black/30"></div>

                    <div class="absolute bottom-5 left-5 text-white">

                        <h3 class="font-semibold text-lg">
                            Pré-jogo
                        </h3>

                        <p class="text-sm text-gray-300">
                            Estilo dentro e fora de campo.
                        </p>

                    </div>

                </div>

                <!-- CARD -->
                <div class="relative rounded-2xl overflow-hidden h-[320px] group border border-white/10">

                    <img 
                        src="{{ asset('img/colecao2.jpg') }}"
                        alt="Coleção"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700"
                    >

                    <div class="absolute inset-0 bg-black/30"></div>

                    <div class="absolute bottom-5 left-5 text-white">

                        <h3 class="font-semibold text-lg">
                            Torcedor
                        </h3>

                        <p class="text-sm text-gray-300">
                            Mostre sua paixão.
                        </p>

                    </div>

                </div>

                <!-- CARD -->
                <div class="relative rounded-2xl overflow-hidden h-[320px] group border border-white/10">

                    <img 
                        src="{{ asset('img/colecao3.jpg') }}"
                        alt="Coleção"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700"
                    >

                    <div class="absolute inset-0 bg-black/30"></div>

                    <div class="absolute bottom-5 left-5 text-white">

                        <h3 class="font-semibold text-lg">
                            Seleções
                        </h3>

                        <p class="text-sm text-gray-300">
                            Vista as cores do seu país.
                        </p>

                    </div>

                </div>

                <!-- CARD -->
                <div class="relative rounded-2xl overflow-hidden h-[320px] group border border-white/10">

                    <img 
                        src="{{ asset('img/colecao4.jpg') }}"
                        alt="Coleção"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700"
                    >

                    <div class="absolute inset-0 bg-black/30"></div>

                    <div class="absolute bottom-5 left-5 text-white">

                        <h3 class="font-semibold text-lg">
                            Lifestyle
                        </h3>

                        <p class="text-sm text-gray-300">
                            Para todos os momentos.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- FOOTER -->
<footer class="bg-white border-t border-gray-200 pt-16 pb-8">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- GRID -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            <!-- AJUDA -->
            <div>

                <h3 class="font-bold text-sm uppercase mb-5">
                    Ajuda
                </h3>

                <ul class="space-y-3 text-gray-600 text-sm">

                    <li>
                        <a href="/ajuda" class="hover:text-black">
                            Central de Ajuda
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-black">
                            Pedidos
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-black">
                            Trocas e Devoluções
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-black">
                            Entregas
                        </a>
                    </li>

                </ul>

            </div>

            <!-- SOBRE -->
            <div>

                <h3 class="font-bold text-sm uppercase mb-5">
                    Sobre Nós
                </h3>

                <ul class="space-y-3 text-gray-600 text-sm">

                    <li>
                        <a href="#" class="hover:text-black">
                            Quem Somos
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-black">
                            Nossa História
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-black">
                            Trabalhe Conosco
                        </a>
                    </li>

                </ul>

            </div>

            <!-- SERVIÇOS -->
            <div>

                <h3 class="font-bold text-sm uppercase mb-5">
                    Serviços
                </h3>

                <ul class="space-y-3 text-gray-600 text-sm">

                    <li>
                        <a href="/personalizado" class="hover:text-black">
                            Personalização
                        </a>
                    </li>

                    <li>
                        <a href="/colecoes" class="hover:text-black">
                            Patches Oficiais
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-black">
                            Cartão Presente
                        </a>
                    </li>

                </ul>

            </div>

            <!-- REDES -->
            <div>

                <h3 class="font-bold text-sm uppercase mb-5">
                    Siga-nos
                </h3>

               <div class="flex items-center gap-5">

    <!-- Instagram -->
    <a href="#" class="text-black hover:opacity-60 transition">
        <svg xmlns="http://www.w3.org/2000/svg" 
            class="w-6 h-6" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor">

            <rect x="2" y="2" width="20" height="20" rx="5" stroke-width="2"/>
            <circle cx="12" cy="12" r="4" stroke-width="2"/>
            <circle cx="18" cy="6" r="1"/>

        </svg>
    </a>

    <!-- Twitter/X -->
    <a href="#" class="text-black hover:opacity-60 transition">
        <svg xmlns="http://www.w3.org/2000/svg" 
            class="w-6 h-6" 
            fill="currentColor" 
            viewBox="0 0 24 24">

            <path d="M18.244 2H21l-6.56 7.497L22.5 22h-6.828l-5.347-6.996L4.2 22H1.44l7.017-8.018L1.5 2h6.997l4.833 6.35L18.244 2zm-1.197 18h1.885L7.476 3.895H5.452L17.047 20z"/>

        </svg>
    </a>

    <!-- YouTube -->
    <a href="#" class="text-black hover:opacity-60 transition">
        <svg xmlns="http://www.w3.org/2000/svg" 
            class="w-6 h-6" 
            fill="currentColor" 
            viewBox="0 0 24 24">

            <path d="M21.8 8s-.2-1.4-.8-2c-.8-.8-1.7-.8-2.1-.9C15.9 4.8 12 4.8 12 4.8h0s-3.9 0-6.9.3c-.4.1-1.3.1-2.1.9-.6.6-.8 2-.8 2S2 9.6 2 11.2v1.5C2 14.4 2.2 16 2.2 16s.2 1.4.8 2c.8.8 1.9.8 2.4.9 1.7.2 6.6.3 6.6.3s3.9 0 6.9-.3c.4-.1 1.3-.1 2.1-.9.6-.6.8-2 .8-2s.2-1.6.2-3.2v-1.5C22 9.6 21.8 8 21.8 8zM9.8 15.5v-7l6.2 3.5-6.2 3.5z"/>

        </svg>
    </a>

    <!-- TikTok -->
    <a href="#" class="text-black hover:opacity-60 transition">
        <svg xmlns="http://www.w3.org/2000/svg" 
            class="w-6 h-6" 
            fill="currentColor" 
            viewBox="0 0 24 24">

            <path d="M19.589 6.686a4.793 4.793 0 01-3.77-4.187V2h-3.358v13.548a2.892 2.892 0 11-2.891-2.892c.298 0 .584.045.853.127V9.36a6.29 6.29 0 00-.853-.059A6.25 6.25 0 1015.82 15.55V8.684a8.154 8.154 0 004.773 1.526V6.686h-.004z"/>

        </svg>
    </a>

</div>




            </div>

        </div>

        <!-- BOTTOM -->
        <div class="border-t border-gray-200 mt-14 pt-6 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">

            <p>
                © 2026 Elite Football Store. Todos os direitos reservados.
            </p>

            <div class="flex gap-6 mt-4 md:mt-0">

                <a href="#" class="hover:text-black">
                    Política de Privacidade
                </a>

                <a href="#" class="hover:text-black">
                    Termos de Uso
                </a>

            </div>

        </div>

    </div>

</footer>

@endsection