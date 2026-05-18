<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function categoria($categoria)
    {
        $produtos = [

            'feminino' => [
                [
                    'nome' => 'Top Fitness Feminino',
                    'preco' => 'R$ 89,90',
                    'imagem' => 'https://via.placeholder.com/250'
                ],

                [
                    'nome' => 'Legging Academia',
                    'preco' => 'R$ 119,90',
                    'imagem' => 'https://via.placeholder.com/250'
                ]
            ],

            'masculino' => [
                [
                    'nome' => 'Camiseta Dry Fit',
                    'preco' => 'R$ 79,90',
                    'imagem' => 'https://via.placeholder.com/250'
                ]
            ],

            'infantil' => [
                [
                    'nome' => 'Conjunto Infantil',
                    'preco' => 'R$ 69,90',
                    'imagem' => 'https://via.placeholder.com/250'
                ]
            ],

            'colecoes' => [
                [
                    'nome' => 'Coleção Verão',
                    'preco' => 'R$ 149,90',
                    'imagem' => 'https://via.placeholder.com/250'
                ]
            ],

            'ofertas' => [
                [
                    'nome' => 'Tênis Promoção',
                    'preco' => 'R$ 199,90',
                    'imagem' => 'https://via.placeholder.com/250'
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