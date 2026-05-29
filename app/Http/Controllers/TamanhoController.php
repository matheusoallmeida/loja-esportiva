<?php

namespace App\Http\Controllers;

use App\Models\Tamanho;
use Illuminate\Http\Request;

class TamanhoController extends Controller
{
    public function index()
    {
        $tamanhos = Tamanho::all();

        return view('tamanhos.index', compact('tamanhos'));
    }

    public function create()
    {
        return view('tamanhos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sigla' => 'required|string|max:10',
            'descricao' => 'required|string|max:255',
        ]);

        Tamanho::create($request->only(['sigla', 'descricao']));

        return redirect()->route('tamanhos.index')->with('success', 'Tamanho criado com sucesso.');
    }

    public function show(Tamanho $tamanho)
    {
        return view('tamanhos.show', compact('tamanho'));
    }

    public function edit(Tamanho $tamanho)
    {
        return view('tamanhos.edit', compact('tamanho'));
    }

    public function update(Request $request, Tamanho $tamanho)
    {
        $request->validate([
            'sigla' => 'required|string|max:10',
            'descricao' => 'required|string|max:255',
        ]);

        $tamanho->update($request->only(['sigla', 'descricao']));

        return redirect()->route('tamanhos.index')->with('success', 'Tamanho atualizado com sucesso.');
    }

    public function destroy(Tamanho $tamanho)
    {
        $tamanho->delete();

        return redirect()->route('tamanhos.index')->with('success', 'Tamanho removido com sucesso.');
    }
}