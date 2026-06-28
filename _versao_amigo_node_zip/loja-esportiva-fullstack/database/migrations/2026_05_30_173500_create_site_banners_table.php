<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_banners', function (Blueprint $table) {
            $table->id();
            $table->string('chave')->unique();
            $table->string('titulo');
            $table->string('subtitulo')->nullable();
            $table->string('imagem');
            $table->string('link')->nullable();
            $table->unsignedInteger('ordem')->default(0);
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_banners');
    }
};
