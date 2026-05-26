<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTA DE CATEGORIAS
    |--------------------------------------------------------------------------
    | Aqui mostramos os produtos de cada categoria
    | Exemplo:
    | /categoria/masculino
    |--------------------------------------------------------------------------
    */
    public function categoria($categoria)
    {
        /*
        |--------------------------------------------------------------------------
        | PRODUTOS MOCKADOS (TEMPORÁRIOS)
        |--------------------------------------------------------------------------
        | Depois isso virá do banco de dados
        |--------------------------------------------------------------------------
        */
        $produtos = [

            'lancamentos' => [

                [
                    'id' => 1,
                    'nome' => 'Novo Tênis Esportivo',
                    'preco' => 299.90,
                    'imagem' => 'produtos/tenis.jpg',
                    'descricao' => 'Tênis confortável e moderno.'
                ],

                [
                    'id' => 2,
                    'nome' => 'Camiseta Performance',
                    'preco' => 129.90,
                    'imagem' => 'produtos/camiseta.jpg',
                    'descricao' => 'Camiseta leve para performance.'
                ]

            ],

            'feminino' => [

                [
                    'id' => 3,
                    'nome' => 'Top Fitness Feminino',
                    'preco' => 89.90,
                    'imagem' => 'produtos/top.jpg',
                    'descricao' => 'Top ideal para academia.'
                ],

                [
                    'id' => 4,
                    'nome' => 'Legging Academia',
                    'preco' => 119.90,
                    'imagem' => 'produtos/legging.jpg',
                    'descricao' => 'Legging confortável e resistente.'
                ]

            ],

            'masculino' => [

                [
                    'id' => 5,
                    'nome' => 'Camiseta Dry Fit',
                    'preco' => 79.90,
                    'imagem' => 'produtos/camiseta.jpg',
                    'descricao' => 'Camiseta respirável para treino.'
                ]

            ],

            'infantil' => [

                [
                    'id' => 6,
                    'nome' => 'Conjunto Infantil',
                    'preco' => 69.90,
                    'imagem' => 'produtos/infantil.jpg',
                    'descricao' => 'Conjunto confortável infantil.'
                ]

            ],

            'colecoes' => [

                [
                    'id' => 7,
                    'nome' => 'Coleção Verão',
                    'preco' => 149.90,
                    'imagem' => 'produtos/verao.jpg',
                    'descricao' => 'Coleção exclusiva de verão.'
                ]

            ],

            'ofertas' => [

                [
                    'id' => 8,
                    'nome' => 'Tênis Promoção',
                    'preco' => 199.90,
                    'imagem' => 'produtos/oferta.jpg',
                    'descricao' => 'Oferta limitada.'
                ]

            ]

        ];

        /*
        |--------------------------------------------------------------------------
        | BUSCA PRODUTOS DA CATEGORIA
        |--------------------------------------------------------------------------
        */
        $listaProdutos = $produtos[$categoria] ?? [];

        /*
        |--------------------------------------------------------------------------
        | RETORNA VIEW DA CATEGORIA
        |--------------------------------------------------------------------------
        */
        return view('produtos.categoria', [
            'categoria' => ucfirst($categoria),
            'produtos' => $listaProdutos
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | PÁGINA DE PRODUTO INDIVIDUAL
    |--------------------------------------------------------------------------
    | Exemplo:
    | /produto/1
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        /*
        |--------------------------------------------------------------------------
        | LISTA DE PRODUTOS
        |--------------------------------------------------------------------------
        */
        $produtos = [

            1 => [
                'id' => 1,
                'nome' => 'Novo Tênis Esportivo',
                'preco' => 299.90,
                'imagem' => 'produtos/tenis.jpg',
                'descricao' => 'Tênis confortável e moderno.'
            ],

            2 => [
                'id' => 2,
                'nome' => 'Camiseta Performance',
                'preco' => 129.90,
                'imagem' => 'produtos/camiseta.jpg',
                'descricao' => 'Camiseta leve para performance.'
            ],

            3 => [
                'id' => 3,
                'nome' => 'Top Fitness Feminino',
                'preco' => 89.90,
                'imagem' => 'produtos/top.jpg',
                'descricao' => 'Top ideal para academia.'
            ],

            4 => [
                'id' => 4,
                'nome' => 'Legging Academia',
                'preco' => 119.90,
                'imagem' => 'produtos/legging.jpg',
                'descricao' => 'Legging confortável e resistente.'
            ],

            5 => [
                'id' => 5,
                'nome' => 'Camiseta Dry Fit',
                'preco' => 79.90,
                'imagem' => 'produtos/camiseta.jpg',
                'descricao' => 'Camiseta respirável para treino.'
            ]

        ];

        /*
        |--------------------------------------------------------------------------
        | PROCURA O PRODUTO PELO ID
        |--------------------------------------------------------------------------
        */
        $produto = $produtos[$id] ?? null;

        /*
        |--------------------------------------------------------------------------
        | SE NÃO EXISTIR -> ERRO 404
        |--------------------------------------------------------------------------
        */
        if (!$produto) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | RETORNA VIEW DO PRODUTO
        |--------------------------------------------------------------------------
        */
        return view('produtos.show', compact('produto'));
    }
}