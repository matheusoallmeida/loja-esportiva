<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\User;
use App\Models\Produto;
use Illuminate\Http\Request;

class VendaController extends Controller
{

    public function index()
    {
        // Admin visualiza todas as vendas
        $vendas = Venda::with(['user', 'produto'])
            ->latest()
            ->get();

        return view('vendas.index', compact('vendas'));
    }


    public function minhasCompras()
    {
        // Cliente visualiza somente suas compras
        $vendas = Venda::with('produto')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('vendas.minhas-compras', compact('vendas'));
    }


    public function create()
    {
        $users = User::all();
        $produtos = Produto::all();

        return view('vendas.create', compact(
            'users',
            'produtos'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'produto_id'  => 'required|exists:produtos,id',
            'quantidade'  => 'required|integer|min:1',
            'valor_total' => 'required|numeric',
            'status'      => 'required|string|max:50',
            'status_pagamento' => 'nullable|string|max:50',
            'codigo_pagamento' => 'nullable|string|max:100',
            'status_entrega' => 'nullable|string|max:50',
            'codigo_entrega' => 'nullable|string|max:100',
            'codigo_rastreio' => 'nullable|string|max:100',
        ]);


        $produto = Produto::findOrFail(
            $request->produto_id
        );


        // Verifica estoque
        if ($produto->estoque < $request->quantidade) {

            return back()->withErrors([
                'quantidade' => 'Estoque insuficiente.'
            ]);

        }


        // Baixa estoque
        $produto->estoque -= $request->quantidade;
        $produto->save();


        Venda::create([
            'user_id'     => $request->user_id,
            'produto_id'  => $request->produto_id,
            'quantidade'  => $request->quantidade,
            'valor_total' => $request->valor_total,
            'status'      => $request->status,
            'status_pagamento' => $request->status_pagamento ?? 'Pendente',
            'codigo_pagamento' => $request->codigo_pagamento,
            'status_entrega' => $request->status_entrega ?? 'Pendente',
            'codigo_entrega' => $request->codigo_entrega,
            'codigo_rastreio' => $request->codigo_rastreio,
        ]);


        return redirect()
            ->route('vendas.index')
            ->with(
                'success',
                'Venda criada com sucesso.'
            );
    }


    public function show(Venda $venda)
    {
        return view('vendas.show', compact('venda'));
    }


    public function edit(Venda $venda)
    {
        $users = User::all();
        $produtos = Produto::all();

        return view('vendas.edit', compact(
            'venda',
            'users',
            'produtos'
        ));
    }


    public function update(Request $request, Venda $venda)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'produto_id'  => 'required|exists:produtos,id',
            'quantidade'  => 'required|integer|min:1',
            'valor_total' => 'required|numeric',
            'status'      => 'required|string|max:50',
            'status_pagamento' => 'nullable|string|max:50',
            'codigo_pagamento' => 'nullable|string|max:100',
            'status_entrega' => 'nullable|string|max:50',
            'codigo_entrega' => 'nullable|string|max:100',
            'codigo_rastreio' => 'nullable|string|max:100',
        ]);


        $produto = Produto::findOrFail(
            $request->produto_id
        );


        // Devolve estoque antigo
        $produto->estoque += $venda->quantidade;


        if ($produto->estoque < $request->quantidade) {

            return back()->withErrors([
                'quantidade' => 'Estoque insuficiente.'
            ]);

        }


        // Atualiza estoque
        $produto->estoque -= $request->quantidade;
        $produto->save();


        $venda->update([
            'user_id'     => $request->user_id,
            'produto_id'  => $request->produto_id,
            'quantidade'  => $request->quantidade,
            'valor_total' => $request->valor_total,
            'status'      => $request->status,
            'status_pagamento' => $request->status_pagamento ?? 'Pendente',
            'codigo_pagamento' => $request->codigo_pagamento,
            'status_entrega' => $request->status_entrega ?? 'Pendente',
            'codigo_entrega' => $request->codigo_entrega,
            'codigo_rastreio' => $request->codigo_rastreio,
        ]);


        return redirect()
            ->route('vendas.index')
            ->with(
                'success',
                'Venda atualizada com sucesso.'
            );
    }



    public function destroy(Venda $venda)
    {
        $produto = $venda->produto;


        // Devolve estoque ao excluir venda
        $produto->estoque += $venda->quantidade;
        $produto->save();


        $venda->delete();


        return redirect()
            ->route('vendas.index')
            ->with(
                'success',
                'Venda removida com sucesso.'
            );
    }
}
