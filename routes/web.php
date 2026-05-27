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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ROTAS DE USUÁRIO LOGADO
Route::middleware('auth')->group(function () {

    // Perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // endereços
    Route::resource('enderecos', EnderecoController::class);


    // Carrinho
    Route::resource('carrinhos', CarrinhoController::class);

    // Checkout
    Route::post('/checkout', [CheckoutController::class, 'finalizar'])
        ->name('checkout.finalizar');
});


// ROTAS SOMENTE ADMIN
Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('users', UserController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('tamanhos', TamanhoController::class);
    Route::resource('cidades', CidadeController::class);
    Route::resource('produtos', ProdutoController::class);
    Route::resource('vendas', VendaController::class);

});

require __DIR__.'/auth.php';