<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteBanner extends Model
{
    protected $fillable = [
        'chave',
        'titulo',
        'subtitulo',
        'imagem',
        'link',
        'ordem',
        'ativo',
    ];
}
