<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vendas', function (Blueprint $table) {
            $table->string('status_pagamento')->default('pendente');
            $table->string('codigo_pagamento')->nullable();

            $table->string('status_entrega')->default('pendente');
            $table->string('codigo_entrega')->nullable();
            $table->string('codigo_rastreio')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('vendas', function (Blueprint $table) {
            $table->dropColumn([
                'status_pagamento',
                'codigo_pagamento',
                'status_entrega',
                'codigo_entrega',
                'codigo_rastreio',
            ]);
        });
    }
};
