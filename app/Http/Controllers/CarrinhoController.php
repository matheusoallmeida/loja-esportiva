<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Produto;
use Illuminate\Http\Request;

// Responsável pelo gerenciamento do carrinho
class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinhos = Carrinho::with(['user', 'produto'])->get();

        return view('carrinhos.index', compact('carrinhos'));
    }

    public function create()
    {
        $produtos = Produto::all();

        return view('carrinhos.create', compact('produtos'));
    }

    // Adiciona produto ao carrinho
    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        Carrinho::create([
            'user_id' => auth()->id(),
            'produto_id' => $request->produto_id,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('carrinhos.index')
            ->with('success', 'Produto adicionado ao carrinho.');
    }

    public function show(Carrinho $carrinho)
    {
        return view('carrinhos.show', compact('carrinho'));
    }

    public function edit(Carrinho $carrinho)
    {
        $produtos = Produto::all();

        return view('carrinhos.edit', compact('carrinho', 'produtos'));
    }

    public function update(Request $request, Carrinho $carrinho)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $carrinho->update([
            'produto_id' => $request->produto_id,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('carrinhos.index')
            ->with('success', 'Carrinho atualizado com sucesso.');
    }

    // Remove itens do carrinho
    public function destroy(Carrinho $carrinho)
    {
        $carrinho->delete();

        return redirect()->route('carrinhos.index')
            ->with('success', 'Item removido do carrinho.');
    }

    // Calcula subtotal dos itens
    public function calcularSubtotal(Carrinho $carrinho)
    {
        return $carrinho->quantidade * $carrinho->produto->preco;
    }
}
