<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IntegracaoConfig;
use App\Models\Venda;

class IntegracaoConfigController extends Controller
{
    public function edit()
    {
        $configs = IntegracaoConfig::lista([
            'cacapay_url' => config('services.cacapay.url'),
            'cacapay_token' => config('services.cacapay.token'),
            'cacalog_url' => config('services.cacalog.url'),
            'cacalog_token' => config('services.cacalog.token'),
            'google_analytics_id' => config('services.google_analytics.measurement_id'),
        ]);

        $status = [
            'pagamentos' => filled($configs['cacapay_url'] ?? null) && filled($configs['cacapay_token'] ?? null),
            'entregas' => filled($configs['cacalog_url'] ?? null) && filled($configs['cacalog_token'] ?? null),
            'analytics' => filled($configs['google_analytics_id'] ?? null),
        ];

        $resumo = [
            'pagamentos_aprovados' => Venda::where('status_pagamento', 'Aprovado')->count(),
            'pagamentos_pendentes' => Venda::whereIn('status_pagamento', ['Pendente', 'pendente'])->count(),
            'entregas_recebidas' => Venda::whereIn('status_entrega', ['Recebido', 'recebido'])->count(),
            'entregas_em_rota' => Venda::whereIn('status_entrega', ['Em rota', 'em_rota'])->count(),
        ];

        return view('admin.configuracoes-integracoes', compact('status', 'resumo'));
    }
}
