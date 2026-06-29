<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tamanho extends Model
{
    protected $fillable = [
        'sigla',
        'descricao',
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class)
            ->withPivot('quantidade')
            ->withTimestamps();
    }
}