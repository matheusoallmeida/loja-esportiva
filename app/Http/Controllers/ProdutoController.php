<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Tamanho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    // Lista todos os produtos cadastrados
    // Também carrega categoria e tamanho junto 
    public function index()
    {
        $produtos = Produto::with(['categoria', 'tamanho'])->get();

        return view('produtos.index', compact('produtos'));
    }
    // Carrega categorias e tamanhos
    // para exibir no formulário de cadastro
    public function create()
    {
        $categorias = Categoria::all();
        $tamanhos = Tamanho::all();

        return view('produtos.create', compact('categorias', 'tamanhos'));
    }

        public function store(Request $request)
    {
        // Valida os dados enviados pelo formulário
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
        // Faz upload da imagem do produto
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem')->store('produtos', 'public');
        }
        // Salva o produto no banco de dados
        Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'estoque' => $request->estoque,
            'categoria_id' => $request->categoria_id,
            'tamanho_id' => $request->tamanho_id,
            'imagem' => $imagem,
        ]);
        // Redireciona o usuário para a listagem
        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto criado com sucesso.');
    }

    public function show(Produto $produto)
    {
        // Exibe os detalhes de um produto específico
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        // Busca os dados necessários para preencher os campos de seleção do formulário
        $categorias = Categoria::all();
        $tamanhos = Tamanho::all();
        // Exibe o formulário de edição com os dados atuais do produto
        return view('produtos.edit', compact('produto', 'categorias', 'tamanhos'));
    }

    public function update(Request $request, Produto $produto)
    {   
        // Valida os dados enviados pelo formulário
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
        // Caso uma nova imagem seja enviada, ela também é atualizada
        if ($request->hasFile('imagem')) {

            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }

            $dados['imagem'] = $request
                ->file('imagem')
                ->store('produtos', 'public');
        }
        // Salva as alterações do produto no banco de dados
        $produto->update($dados);

        // Redireciona o usuário para a listagem
        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso.');
    }

        public function destroy(Produto $produto)
        {
            // Remove o arquivo de imagem do servidor se ele existir
            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }
            // Exclui o registro do produto do banco de dados
            $produto->delete();
            
            // Redireciona para a listagem com mensagem de sucesso
            return redirect()
                ->route('produtos.index')
                ->with('success', 'Produto removido com sucesso.');
        }
}