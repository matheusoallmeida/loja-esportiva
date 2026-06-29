<?php

namespace App\Services;

use App\Models\IntegracaoConfig;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class CacaPayService
{
    public function comprar($user, float $valor): array
    {
        $url = IntegracaoConfig::valor('cacapay_url', config('services.cacapay.url'));
        $token = IntegracaoConfig::valor('cacapay_token', config('services.cacapay.token'));

        if (! $url || ! $token) {
            return [
                'aprovado' => false,
                'message' => 'URL e token da CacaPay precisam ser configurados.',
            ];
        }

        $request = Http::acceptJson()->timeout(20);

        if (app()->environment('local')) {
            $request = $request->withoutVerifying();
        }

        try {
            $response = $request->post(rtrim($url, '/') . '/api/compras', [
                'cpf' => $user->cpf,
                'token' => $token,
                'valor' => $valor,
                'nome' => $user->name,
                'email' => $user->email,
            ]);
        } catch (ConnectionException) {
            return [
                'aprovado' => false,
                'message' => 'Nao foi possivel conectar com a CacaPay. Tente novamente em instantes.',
            ];
        }

        if ($response->failed()) {
            return [
                'aprovado' => false,
                'message' => $response->json('message') ?? 'Pagamento recusado.',
            ];
        }

        return [
            'aprovado' => $response->json('status.nome') === 'Aprovado',
            'codigo' => $response->json('id'),
            'status' => $response->json('status.nome'),
            'data' => $response->json(),
        ];
    }
}
