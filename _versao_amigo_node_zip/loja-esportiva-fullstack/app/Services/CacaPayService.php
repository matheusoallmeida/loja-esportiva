<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CacaPayService
{
    public function comprar($user, float $valor): array
    {
        $response = Http::acceptJson()->post(config('services.cacapay.url') . '/api/compras', [
            'cpf' => $user->cpf,
            'token' => config('services.cacapay.token'),
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
}