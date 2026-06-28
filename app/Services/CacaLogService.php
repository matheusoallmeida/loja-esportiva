<?php

namespace App\Services;

use App\Models\IntegracaoConfig;
use Illuminate\Support\Facades\Http;

class CacaLogService
{
    public function criarEntrega($venda, $endereco): array
    {
        $url = IntegracaoConfig::valor('cacalog_url', config('services.cacalog.url'));
        $token = IntegracaoConfig::valor('cacalog_token', config('services.cacalog.token'));
        $callbackUrl = IntegracaoConfig::valor('callback_url', route('logistica.callback'));

        if (! $url || ! $token) {
            return [
                'criado' => false,
                'message' => 'URL e token da CacaLog precisam ser configurados.',
            ];
        }

        $response = Http::acceptJson()->post(rtrim($url, '/') . '/api/entregas', [
            'token' => $token,
            'codigo_pedido' => 'VENDA-' . $venda->id,
            'callback' => $callbackUrl,
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
