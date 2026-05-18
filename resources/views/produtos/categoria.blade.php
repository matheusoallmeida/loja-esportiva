<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $categoria }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- TÍTULO -->
        <h1 class="text-4xl font-bold mb-10 capitalize">
            {{ $categoria }}
        </h1>

        <!-- GRID DE PRODUTOS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

            @for ($i = 1; $i <= 12; $i++)

                <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition">

                    <!-- IMAGEM -->
                    <img 
                        src="https://picsum.photos/400/500?random={{ $i }}"
                        class="w-full h-80 object-cover"
                    >

                    <!-- INFO -->
                    <div class="p-4">

                        <h2 class="font-semibold text-lg">
                            Camiseta Dry Fit
                        </h2>

                        <p class="text-gray-500 text-sm mt-1">
                            Produto esportivo premium
                        </p>

                        <p class="text-2xl font-bold mt-4">
                            R$ 79,90
                        </p>

                        <button class="w-full bg-black text-white py-3 rounded-xl mt-4 hover:bg-gray-800 transition">
                            Comprar
                        </button>

                    </div>

                </div>

            @endfor

        </div>

    </div>

</body>
</html>