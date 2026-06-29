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
<<<<<<< HEAD
            'codigo_rastreio' => 'nullable',
=======
>>>>>>> 422371e18e4897bef7cb69ebb84937851c9c8f92
        ]);

        $venda = Venda::where('id', str_replace('VENDA-', '', $request->codigo_pedido))->first();

        if (!$venda) {
            return response()->json([
                'message' => 'Venda não encontrada',
            ], 404);
        }

        $venda->update([
            'status_entrega' => $request->status,
<<<<<<< HEAD
            'codigo_rastreio' => $request->codigo_rastreio ?? $venda->codigo_rastreio,
=======
>>>>>>> 422371e18e4897bef7cb69ebb84937851c9c8f92
        ]);

        return response()->json([
            'message' => 'Status atualizado com sucesso',
        ]);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 422371e18e4897bef7cb69ebb84937851c9c8f92
