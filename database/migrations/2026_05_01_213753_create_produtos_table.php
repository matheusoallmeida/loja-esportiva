<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Criação da tabela de produtos
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao');
            $table->decimal('preco', 10, 2);
            $table->integer('estoque');

            // Chave estrangeira para categoria
            // Relaciona produto com categorias
            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->cascadeOnDelete();

            // Chave estrangeira para tamanho
            // Relaciona produto com tamanhos
            $table->foreignId('tamanho_id')
                ->constrained('tamanhos')
                ->cascadeOnDelete();

            $table->timestamps();

            // Campo para armazenar caminho da imagem
            $table->string('imagem')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
