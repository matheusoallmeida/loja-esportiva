<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'user_id',
        'cidade_id',
        'logradouro',
        'numero',
        'bairro',
        'cep',
        'descricao',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }
}