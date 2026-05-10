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

@endsection