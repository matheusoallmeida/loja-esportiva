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
use App\Models\Produto;
use App\Models\User;
use App\Models\Venda;

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

    try {
        $metricas = [
            'vendas' => Venda::count(),
            'clientes' => User::where('role', 'cliente')->count(),
            'produtos' => Produto::count(),
            'faturamento' => Venda::sum('valor_total'),
        ];

        $statusVendas = Venda::selectRaw("COALESCE(status, 'Pendente') as status, COUNT(*) as total")
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

    $chartFaturamento = [
        'labels' => ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
        'values' => [1200, 1850, 2400, 2100, 3600, max(4200, (float) $metricas['faturamento'])],
    ];

    return view('dashboard', compact('metricas', 'chartVendas', 'chartFaturamento'));
})->middleware(['auth', 'verified'])->name('dashboard');

/*
| ROTAS DE USUÁRIO LOGADO
*/

Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Endereços
    Route::resource('enderecos', EnderecoController::class);
    // Carrinho
    Route::resource('carrinhos', CarrinhoController::class);
    // Checkout
    Route::post('/checkout', [CheckoutController::class, 'finalizar'])
        ->name('checkout.finalizar');
    Route::get('/minhas-compras', [VendaController::class, 'minhasCompras'])
        ->name('cliente.compras');       

});

/*
| ROTAS LIBERADAS TEMPORARIAMENTE PARA TESTES
| Depois basta voltar o middleware admin.
|Route::resource('users', UserController::class);
|Route::resource('categorias', CategoriaController::class);
|Route::resource('tamanhos', TamanhoController::class);
|Route::resource('cidades', CidadeController::class);
|Route::resource('produtos', ProdutoController::class)
    ->except(['show']);
|Route::resource('vendas', VendaController::class);
*/


// ROTAS SOMENTE ADMIN
Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('users', UserController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('tamanhos', TamanhoController::class);
    Route::resource('cidades', CidadeController::class);
    Route::resource('produtos', ProdutoController::class);
    Route::resource('vendas', VendaController::class);

    Route::view('/admin/configuracoes-integracoes', 'admin.configuracoes-integracoes')
        ->name('admin.configuracoes');

});

require __DIR__.'/auth.php';
