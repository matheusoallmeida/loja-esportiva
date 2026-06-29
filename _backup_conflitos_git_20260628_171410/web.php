<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TamanhoController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Api\LogisticaCallbackController;
<<<<<<< HEAD
use App\Http\Controllers\Admin\IntegracaoConfigController;
use App\Models\IntegracaoConfig;
use App\Models\Produto;
use App\Models\User;
use App\Models\Venda;
=======
>>>>>>> 422371e18e4897bef7cb69ebb84937851c9c8f92

/*
| PÁGINA INICIAL
*/
Route::get('/', [WelcomeController::class, 'index']);

/*
| PRODUTO
*/
Route::get('/produto/{produto}', [ProdutoController::class, 'show'])
    ->name('produto.show');

Route::get('/produto-demo/{slug}', function (string $slug) {
    $produto = collect(config('mantra_demo_products'))
        ->firstWhere('slug', $slug);

    abort_if(! $produto, 404);

    return view('produtos.demo-show', compact('produto'));
})->name('produto.demo');

/*
| DASHBOARD
*/
Route::get('/dashboard', function () {
<<<<<<< HEAD
    $metricas = [
        'vendas' => 0,
        'clientes' => 0,
        'produtos' => 0,
        'faturamento' => 0,
        'pagamentos_aprovados' => 0,
        'entregas_recebidas' => 0,
    ];

    $chartFaturamento = [
        'labels' => collect(range(5, 0))->map(fn ($mes) => now()->subMonths($mes)->format('m/Y'))->all(),
        'values' => array_fill(0, 6, 0),
    ];

    $chartVendas = [
        'labels' => ['Pendente', 'Finalizada', 'Cancelada'],
        'values' => [0, 0, 0],
    ];

    $chartPagamentos = [
        'labels' => ['Pendente', 'Aprovado', 'Recusado'],
        'values' => [0, 0, 0],
    ];

    try {
        $vendas = Venda::query()->latest()->get();

        $metricas = [
            'vendas' => $vendas->count(),
            'clientes' => User::where('role', 'cliente')->count(),
            'produtos' => Produto::count(),
            'faturamento' => $vendas->sum('valor_total'),
            'pagamentos_aprovados' => $vendas->where('status_pagamento', 'Aprovado')->count(),
            'entregas_recebidas' => $vendas->whereIn('status_entrega', ['Recebido', 'recebido'])->count(),
        ];

        $porMes = $vendas
            ->groupBy(fn ($venda) => optional($venda->created_at)->format('m/Y'))
            ->map(fn ($grupo) => (float) $grupo->sum('valor_total'));

        $chartFaturamento['values'] = collect($chartFaturamento['labels'])
            ->map(fn ($label) => $porMes->get($label, 0))
            ->all();

        $statusVendas = $vendas->groupBy(fn ($venda) => $venda->status ?: 'Pendente')
            ->map->count();

        if ($statusVendas->isNotEmpty()) {
            $chartVendas = [
                'labels' => $statusVendas->keys()->values()->all(),
                'values' => $statusVendas->values()->all(),
            ];
        }

        $statusPagamentos = $vendas->groupBy(fn ($venda) => $venda->status_pagamento ?: 'Pendente')
            ->map->count();

        if ($statusPagamentos->isNotEmpty()) {
            $chartPagamentos = [
                'labels' => $statusPagamentos->keys()->values()->all(),
                'values' => $statusPagamentos->values()->all(),
            ];
        }
    } catch (\Throwable) {
        //
    }

    $integracoes = IntegracaoConfig::lista([
        'cacapay_url' => config('services.cacapay.url'),
        'cacapay_token' => config('services.cacapay.token'),
        'cacalog_url' => config('services.cacalog.url'),
        'cacalog_token' => config('services.cacalog.token'),
        'google_analytics_id' => config('services.google_analytics.measurement_id'),
    ]);

    return view('dashboard', compact(
        'metricas',
        'chartFaturamento',
        'chartVendas',
        'chartPagamentos',
        'integracoes'
    ));
=======
    return view('dashboard');
>>>>>>> 422371e18e4897bef7cb69ebb84937851c9c8f92
})->middleware(['auth', 'verified'])->name('dashboard');

/*
| CALLBACK LOGÍSTICA
*/
Route::post('/logistica/callback', [LogisticaCallbackController::class, 'receber'])
    ->name('logistica.callback');

/*
| ROTAS DE USUÁRIO LOGADO
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('enderecos', EnderecoController::class);
    Route::resource('carrinhos', CarrinhoController::class);

    Route::post('/checkout', [CheckoutController::class, 'finalizar'])
        ->name('checkout.finalizar');

    Route::get('/minhas-compras', [VendaController::class, 'minhasCompras'])
        ->name('cliente.compras');
});

/*
| ROTAS SOMENTE ADMIN
*/
Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('users', UserController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('tamanhos', TamanhoController::class);
    Route::resource('cidades', CidadeController::class);
    Route::resource('produtos', ProdutoController::class);
    Route::resource('vendas', VendaController::class);

<<<<<<< HEAD
    Route::get('/admin/configuracoes-integracoes', [IntegracaoConfigController::class, 'edit'])
        ->name('admin.configuracoes');

=======
>>>>>>> 422371e18e4897bef7cb69ebb84937851c9c8f92
});

require __DIR__.'/auth.php';