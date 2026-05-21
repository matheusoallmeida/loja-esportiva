<?php

// Model responsável pelos produtos da loja


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    // Permite inserção em massa desses campos
    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'estoque',
        'categoria_id',
        'tamanho_id',
        'imagem',
    ];
    // Relacionamento do produto com categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    // Relacionamento do produto com tamanho
    public function tamanho()
    {
        return $this->belongsTo(Tamanho::class);
    }
}