<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Tamanho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with(['categoria', 'tamanho'])->get();

        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $tamanhos = Tamanho::all();

        return view('produtos.create', compact('categorias', 'tamanhos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric',
            'estoque' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'tamanho_id' => 'required|exists:tamanhos,id',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagem = null;

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem')->store('produtos', 'public');
        }

        Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'estoque' => $request->estoque,
            'categoria_id' => $request->categoria_id,
            'tamanho_id' => $request->tamanho_id,
            'imagem' => $imagem,
        ]);

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto criado com sucesso.');
    }

    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::all();
        $tamanhos = Tamanho::all();

        return view('produtos.edit', compact('produto', 'categorias', 'tamanhos'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric',
            'estoque' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'tamanho_id' => 'required|exists:tamanhos,id',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $dados = [
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'estoque' => $request->estoque,
            'categoria_id' => $request->categoria_id,
            'tamanho_id' => $request->tamanho_id,
        ];

        if ($request->hasFile('imagem')) {

            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }

            $dados['imagem'] = $request
                ->file('imagem')
                ->store('produtos', 'public');
        }

        $produto->update($dados);

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso.');
    }

        public function destroy(Produto $produto)
        {

            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }

            $produto->delete();

            return redirect()
                ->route('produtos.index')
                ->with('success', 'Produto removido com sucesso.');
        }
}