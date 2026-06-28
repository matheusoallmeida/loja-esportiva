<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Venda;
use App\Models\Produto;
use App\Models\Endereco;
use App\Services\CacaPayService;
use App\Services\CacaLogService;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function finalizar(CacaPayService $cacaPayService, CacaLogService $cacaLogService)
    {
        $user = auth()->user();

        $carrinhos = Carrinho::with('produto')
            ->where('user_id', $user->id)
            ->get();

        if ($carrinhos->isEmpty()) {
            return redirect()->route('carrinhos.index')
                ->with('success', 'Carrinho vazio.');
        }

        $endereco = Endereco::where('user_id', $user->id)->first();

        if (!$endereco) {
            return redirect()->route('enderecos.create')
                ->withErrors([
                    'endereco' => 'Cadastre um endereço antes de finalizar a compra.'
                ]);
        }

        foreach ($carrinhos as $item) {
            if ($item->produto->estoque < $item->quantidade) {
                return redirect()->route('carrinhos.index')
                    ->withErrors([
                        'quantidade' => 'Estoque insuficiente para o produto: ' . $item->produto->nome
                    ]);
            }
        }

        $valorTotalCarrinho = $carrinhos->sum(function ($item) {
            return $item->produto->preco * $item->quantidade;
        });

        $pagamento = $cacaPayService->comprar($user, $valorTotalCarrinho);

        if (!$pagamento['aprovado']) {
            return redirect()->route('carrinhos.index')
                ->withErrors([
                    'pagamento' => $pagamento['message'] ?? 'Pagamento recusado.'
                ]);
        }

        DB::transaction(function () use ($carrinhos, $user, $endereco, $pagamento, $cacaLogService) {
            foreach ($carrinhos as $item) {
                $produto = Produto::findOrFail($item->produto_id);

                $produto->estoque -= $item->quantidade;
                $produto->save();

                $vendaTotal = $produto->preco * $item->quantidade;

                $venda = Venda::create([
                    'user_id' => $user->id,
                    'produto_id' => $produto->id,
                    'quantidade' => $item->quantidade,
                    'valor_total' => $vendaTotal,
                    'status' => 'Pendente',

                    'status_pagamento' => $pagamento['status'] ?? 'Aprovado',
                    'codigo_pagamento' => $pagamento['codigo'] ?? null,

                    'status_entrega' => 'Pendente',
                    'codigo_entrega' => null,
                    'codigo_rastreio' => null,
                ]);

                $entrega = $cacaLogService->criarEntrega($venda, $endereco);

                if ($entrega['criado']) {
                    $venda->update([
                        'status_entrega' => $entrega['status'] ?? 'Pendente',
                        'codigo_entrega' => $entrega['codigo_entrega'] ?? null,
                    ]);
                }
            }

            Carrinho::where('user_id', $user->id)->delete();
        });

        return redirect()->route('cliente.compras')
            ->with('success', 'Checkout realizado com sucesso.');
    }
}