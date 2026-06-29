<?php

namespace App\Services;

<<<<<<< HEAD
use App\Models\IntegracaoConfig;
=======
>>>>>>> 422371e18e4897bef7cb69ebb84937851c9c8f92
use Illuminate\Support\Facades\Http;

class CacaPayService
{
    public function comprar($user, float $valor): array
    {
<<<<<<< HEAD
        $url = IntegracaoConfig::valor('cacapay_url', config('services.cacapay.url'));
        $token = IntegracaoConfig::valor('cacapay_token', config('services.cacapay.token'));

        if (! $url || ! $token) {
            return [
                'aprovado' => false,
                'message' => 'URL e token da CacaPay precisam ser configurados.',
            ];
        }

        $response = Http::acceptJson()->post(rtrim($url, '/') . '/api/compras', [
            'cpf' => $user->cpf,
            'token' => $token,
=======
        $response = Http::acceptJson()->post(config('services.cacapay.url') . '/api/compras', [
            'cpf' => $user->cpf,
            'token' => config('services.cacapay.token'),
>>>>>>> 422371e18e4897bef7cb69ebb84937851c9c8f92
            'valor' => $valor,
            'nome' => $user->name,
            'email' => $user->email,
        ]);

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
<<<<<<< HEAD
}
=======
}
>>>>>>> 422371e18e4897bef7cb69ebb84937851c9c8f92
