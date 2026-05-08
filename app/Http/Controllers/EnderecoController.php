<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\User;
use App\Models\Cidade;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function index()
    {
        $enderecos = Endereco::with(['user', 'cidade'])->get();

        return view('enderecos.index', compact('enderecos'));
    }

    public function create()
    {
        $users = User::all();
        $cidades = Cidade::all();

        return view('enderecos.create', compact('users', 'cidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cidade_id' => 'required|exists:cidades,id',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'bairro' => 'required|string|max:255',
            'cep' => 'required|string|max:10',
            'descricao' => 'required|string|max:255',
        ]);

        Endereco::create($request->only([
            'user_id',
            'cidade_id',
            'logradouro',
            'numero',
            'bairro',
            'cep',
            'descricao',
        ]));

        return redirect()->route('enderecos.index')->with('success', 'Endereço criado com sucesso.');
    }

    public function show(Endereco $endereco)
    {
        return view('enderecos.show', compact('endereco'));
    }

    public function edit(Endereco $endereco)
    {
        $users = User::all();
        $cidades = Cidade::all();

        return view('enderecos.edit', compact('endereco', 'users', 'cidades'));
    }

    public function update(Request $request, Endereco $endereco)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cidade_id' => 'required|exists:cidades,id',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'bairro' => 'required|string|max:255',
            'cep' => 'required|string|max:10',
            'descricao' => 'required|string|max:255',
        ]);

        $endereco->update($request->only([
            'user_id',
            'cidade_id',
            'logradouro',
            'numero',
            'bairro',
            'cep',
            'descricao',
        ]));

        return redirect()->route('enderecos.index')->with('success', 'Endereço atualizado com sucesso.');
    }

    public function destroy(Endereco $endereco)
    {
        $endereco->delete();

        return redirect()->route('enderecos.index')->with('success', 'Endereço removido com sucesso.');
    }
}