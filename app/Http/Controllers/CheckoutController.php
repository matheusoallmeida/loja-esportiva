<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Venda;
use App\Models\Produto;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Finaliza a compra do cliente
    public function finalizar()
    {
        $carrinhos = Carrinho::with('produto')
            ->where('user_id', auth()->id())
            ->get();

        if ($carrinhos->isEmpty()) {
            return redirect()->route('carrinhos.index')
                ->with('success', 'Carrinho vazio.');
        }

        foreach ($carrinhos as $item) {

            $produto = Produto::findOrFail($item->produto_id);

            if ($produto->estoque < $item->quantidade) {
                return redirect()->route('carrinhos.index')
                    ->withErrors([
                        'quantidade' => 'Estoque insuficiente para o produto: ' . $produto->nome
                    ]);
            }

            $produto->estoque -= $item->quantidade;
            $produto->save();

            // Calcula valor total da compra
            $venda_total = $produto->preco * $item->quantidade;

            Venda::create([
                'user_id' => auth()->id(),
                'produto_id' => $produto->id,
                'quantidade' => $item->quantidade,
                'valor_total' => $venda_total,
                'status' => 'Pendente',
            ]);
        }

        // Remove itens do carrinho após checkout
        Carrinho::where('user_id', auth()->id())->delete();

        return redirect()->route('vendas.index')
            ->with('success', 'Checkout realizado com sucesso.');
    }
}
