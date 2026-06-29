<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Throwable;

class IntegracaoConfig extends Model
{
    protected $table = 'integracao_configs';

    protected $fillable = [
        'chave',
        'valor',
    ];

    public static function valor(string $chave, ?string $padrao = null): ?string
    {
        try {
            if (! Schema::hasTable('integracao_configs')) {
                return $padrao;
            }

            return static::query()->where('chave', $chave)->value('valor') ?? $padrao;
        } catch (Throwable) {
            return $padrao;
        }
    }

    public static function salvarValor(string $chave, ?string $valor): void
    {
        static::query()->updateOrCreate(
            ['chave' => $chave],
            ['valor' => $valor]
        );
    }

    public static function lista(array $padroes = []): array
    {
        try {
            if (! Schema::hasTable('integracao_configs')) {
                return $padroes;
            }

            return array_merge(
                $padroes,
                static::query()->pluck('valor', 'chave')->all()
            );
        } catch (Throwable) {
            return $padroes;
        }
    }
}
