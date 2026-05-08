<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'estoque',
        'categoria_id',
        'tamanho_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function tamanho()
    {
        return $this->belongsTo(Tamanho::class);
    }
}