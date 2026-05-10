@extends('layouts.app')

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

@endsection