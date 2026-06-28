<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Venda;
use Illuminate\Http\Request;

class LogisticaCallbackController extends Controller
{
    public function receber(Request $request)
    {
        $request->validate([
            'codigo_pedido' => 'required',
            'status' => 'required',
            'codigo_rastreio' => 'nullable',
        ]);

        $venda = Venda::where('id', str_replace('VENDA-', '', $request->codigo_pedido))->first();

        if (!$venda) {
            return response()->json([
                'message' => 'Venda não encontrada',
            ], 404);
        }

        $venda->update([
            'status_entrega' => $request->status,
            'codigo_rastreio' => $request->codigo_rastreio ?? $venda->codigo_rastreio,
        ]);

        return response()->json([
            'message' => 'Status atualizado com sucesso',
        ]);
    }
}
