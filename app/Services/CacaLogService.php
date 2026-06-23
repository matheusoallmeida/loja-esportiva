<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CacaLogService
{
    public function criarEntrega($venda, $endereco): array
    {
        $response = Http::acceptJson()->post(config('services.cacalog.url') . '/api/entregas', [
            'token' => config('services.cacalog.token'),
            'codigo_pedido' => 'VENDA-' . $venda->id,
            'cep' => $endereco->cep,
            'logradouro' => $endereco->logradouro,
            'numero' => $endereco->numero,
            'complemento' => '',
            'bairro' => $endereco->bairro,
            'nome_destinatario' => $venda->user->name,
            'conteudo' => [
                [
                    'nome' => $venda->produto->nome,
                    'quantidade' => $venda->quantidade,
                ]
            ],
        ]);

        if ($response->failed()) {
            return [
                'criado' => false,
                'message' => $response->json('message') ?? 'Erro ao criar entrega.',
            ];
        }

        return [
            'criado' => true,
            'codigo_entrega' => $response->json('data.id'),
            'status' => $response->json('data.status'),
            'data' => $response->json(),
        ];
    }
}