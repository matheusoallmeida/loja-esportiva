<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// ============================
// ROTAS DA LOJA
// ============================

Route::get('/lancamentos', function () {
    return view('pages.lancamentos');
});

Route::get('/masculino', function () {
    return view('pages.masculino');
});

Route::get('/feminino', function () {
    return view('pages.feminino');
});

Route::get('/infantil', function () {
    return view('pages.infantil');
});

Route::get('/personalizado', function () {
    return view('pages.personalizado');
});

Route::get('/colecoes', function () {
    return view('pages.colecoes');
});

Route::get('/ofertas', function () {
    return view('pages.ofertas');
});