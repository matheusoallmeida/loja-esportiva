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
        $vendas = Venda::with(['user', 'produto'])->get();

        return view('vendas.index', compact('vendas'));
    }

    public function create()
    {
        $users = User::all();
        $produtos = Produto::all();

        return view('vendas.create', compact('users', 'produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'valor_total' => 'required|numeric',
            'status' => 'required|string|max:50',
        ]);

        Venda::create($request->only([
            'user_id',
            'produto_id',
            'quantidade',
            'valor_total',
            'status',
        ]));

        return redirect()->route('vendas.index')->with('success', 'Venda criada com sucesso.');
    }

    public function show(Venda $venda)
    {
        return view('vendas.show', compact('venda'));
    }

    public function edit(Venda $venda)
    {
        $users = User::all();
        $produtos = Produto::all();

        return view('vendas.edit', compact('venda', 'users', 'produtos'));
    }

    public function update(Request $request, Venda $venda)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'valor_total' => 'required|numeric',
            'status' => 'required|string|max:50',
        ]);

        $venda->update($request->only([
            'user_id',
            'produto_id',
            'quantidade',
            'valor_total',
            'status',
        ]));

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso.');
    }

    public function destroy(Venda $venda)
    {
        $venda->delete();

        return redirect()->route('vendas.index')->with('success', 'Venda removida com sucesso.');
    }
}