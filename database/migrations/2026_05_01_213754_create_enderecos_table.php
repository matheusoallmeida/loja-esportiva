<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->string('logradouro');
            $table->string('numero', 20);
            $table->string('bairro');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('cidade_id')->constrained('cidades')->cascadeOnDelete();
            $table->string('cep');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};
