<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::get('/categoria/{categoria}', [ProdutoController::class, 'categoria']);

Route::get('/buscar', function (Request $request) {
    $q = $request->input('q');

    $produtos = [
        ['id' => 1, 'nome' => 'Camiseta Nike'],
        ['id' => 2, 'nome' => 'Camisa Adidas'],
        ['id' => 3, 'nome' => 'Shorts Esportivo'],
    ];

    $filtrados = array_filter($produtos, function ($p) use ($q) {
        return str_contains(strtolower($p['nome']), strtolower($q));
    });

    return response()->json(array_values($filtrados));
});

/*
|--------------------------------------------------------------------------
| PAGINA INICIAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD GERENCIAL
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    $metricas = [
        'vendas' => 12,
        'clientes' => 8,
        'produtos' => 16,
        'faturamento' => 4200,
    ];

    $chartVendas = [
        'labels' => ['Pendente', 'Finalizada', 'Cancelada'],
        'values' => [3, 8, 1],
    ];

    if (
        class_exists(\App\Models\Venda::class)
        && class_exists(\App\Models\User::class)
        && class_exists(\App\Models\Produto::class)
    ) {
        try {
            $metricas = [
                'vendas' => \App\Models\Venda::count(),
                'clientes' => \App\Models\User::where('role', 'cliente')->count(),
                'produtos' => \App\Models\Produto::count(),
                'faturamento' => \App\Models\Venda::sum('valor_total'),
            ];

            $statusVendas = \App\Models\Venda::selectRaw("COALESCE(status, 'Pendente') as status, COUNT(*) as total")
                ->groupBy('status')
                ->pluck('total', 'status');

            if ($statusVendas->isNotEmpty()) {
                $chartVendas = [
                    'labels' => $statusVendas->keys()->values(),
                    'values' => $statusVendas->values(),
                ];
            }
        } catch (Throwable) {
            //
        }
    }

    $chartFaturamento = [
        'labels' => ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
        'values' => [1200, 1850, 2400, 2100, 3600, max(4200, (float) $metricas['faturamento'])],
    ];

    return view('dashboard', compact('metricas', 'chartVendas', 'chartFaturamento'));
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ROTAS DA LOJA (CATEGORIAS)
|--------------------------------------------------------------------------
*/

Route::view('/personalizado', 'pages.personalizado');
Route::view('/acompanhar-pedido', 'pages.pedidos');
Route::view('/carrinho', 'pages.carrinho');
Route::view('/ajuda', 'pages.ajuda');

Route::redirect('/lancamentos', '/categoria/lancamentos');
Route::redirect('/masculino', '/categoria/masculino');
Route::redirect('/feminino', '/categoria/feminino');
Route::redirect('/infantil', '/categoria/infantil');
Route::redirect('/colecoes', '/categoria/colecoes');
Route::redirect('/ofertas', '/categoria/ofertas');

/*
|--------------------------------------------------------------------------
| ROTAS AUTENTICADAS (BREEZE)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| ROTAS PARA PRODUTOS E TELAS FRONT-END
|--------------------------------------------------------------------------
*/

Route::get('/produto/{id}', [ProdutoController::class, 'show']);

Route::view('/checkout', 'pages.checkout');
Route::view('/enderecos', 'pages.enderecos');
Route::view('/minhas-compras', 'pages.minhas-compras');
Route::view('/admin/produtos', 'admin.produtos');
Route::view('/admin/produtos/novo', 'admin.novo-produto');
