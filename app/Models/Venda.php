<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        //Antes Integracao API
        'user_id',
        'produto_id',
        'quantidade',
        'valor_total',
        'status',
        // Depois Integracao API
        'status_pagamento',
        'codigo_pagamento',
        'status_entrega',
        'codigo_entrega',
        'codigo_rastreio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}