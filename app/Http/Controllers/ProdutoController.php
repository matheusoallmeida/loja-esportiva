<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function categoria($categoria)
    {
        $produtos = [

            'lancamentos' => [
                [
                    'nome' => 'Novo Tênis Esportivo',
                    'preco' => 299.90,
                    'imagem' => 'produtos/tenis.jpg'
                ],

                [
                    'nome' => 'Camiseta Performance',
                    'preco' => 129.90,
                    'imagem' => 'produtos/camiseta.jpg'
                ]
            ],

            'feminino' => [
                [
                    'nome' => 'Top Fitness Feminino',
                    'preco' => 89.90,
                    'imagem' => 'produtos/top.jpg'
                ],

                [
                    'nome' => 'Legging Academia',
                    'preco' => 119.90,
                    'imagem' => 'produtos/legging.jpg'
                ]
            ],

            'masculino' => [
                [
                    'nome' => 'Camiseta Dry Fit',
                    'preco' => 79.90,
                    'imagem' => 'produtos/camiseta.jpg'
                ]
            ],

            'infantil' => [
                [
                    'nome' => 'Conjunto Infantil',
                    'preco' => 69.90,
                    'imagem' => 'produtos/infantil.jpg'
                ]
            ],

            'colecoes' => [
                [
                    'nome' => 'Coleção Verão',
                    'preco' => 149.90,
                    'imagem' => 'produtos/verao.jpg'
                ]
            ],

            'ofertas' => [
                [
                    'nome' => 'Tênis Promoção',
                    'preco' => 199.90,
                    'imagem' => 'produtos/oferta.jpg'
                ]
            ]

        ];

        $listaProdutos = $produtos[$categoria] ?? [];

        return view('produtos.categoria', [
            'categoria' => ucfirst($categoria),
            'produtos' => $listaProdutos
        ]);
    }
}