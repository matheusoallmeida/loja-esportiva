<?php

// Model responsável pelos usuários do sistema

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Define os campos que permitem inserção em massa
#[Fillable([
    'name',
    'cpf',
    'rg',
    'data_nascimento',
    'telefone',
    'email',
    'password',
    'role'
])]
// Oculta os campos em serializações como JSON
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    // Habilita as factories e o envio de notificações
    use HasFactory, Notifiable;

    // Define as conversões de tipo para os atributos
    protected function casts(): array
    {
        return [
            'data_nascimento' => 'date',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

