<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProdutoController;


Route::get('/categoria/{categoria}', [ProdutoController::class, 'categoria']);

Route::get('/buscar', function (Request $request) {

    $q = $request->input('q');

    // simulação (depois vira banco)
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
| PÁGINA INICIAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD (BREEZE)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
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


/* categorias */
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


/* ROTAS PARA PRODUTOS INDIVIDUAIS  */

Route::get('/produto/{id}', [ProdutoController::class, 'show']);


/* rota do carrinho */
Route::view('/checkout', 'pages.checkout');