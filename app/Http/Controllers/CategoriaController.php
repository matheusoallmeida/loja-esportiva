<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with('categoriaPai')->get();

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        $categorias = Categoria::all();

        return view('categorias.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria_pai' => 'nullable|exists:categorias,id',
        ]);

        Categoria::create($request->only(['nome', 'categoria_pai']));

        return redirect()->route('categorias.index')->with('success', 'Categoria criada com sucesso.');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        $categorias = Categoria::where('id', '!=', $categoria->id)->get();

        return view('categorias.edit', compact('categoria', 'categorias'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria_pai' => 'nullable|exists:categorias,id',
        ]);

        $categoria->update($request->only(['nome', 'categoria_pai']));

        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoria removida com sucesso.');
    }
}