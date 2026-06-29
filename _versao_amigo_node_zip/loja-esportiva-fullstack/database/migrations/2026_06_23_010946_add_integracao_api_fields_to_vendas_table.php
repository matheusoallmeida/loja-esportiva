<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vendas', function (Blueprint $table) {
            $table->string('status_pagamento')->default('pendente')->after('status');
            $table->string('codigo_pagamento')->nullable()->after('status_pagamento');

            $table->string('status_entrega')->default('pendente')->after('codigo_pagamento');
            $table->string('codigo_entrega')->nullable()->after('status_entrega');
            $table->string('codigo_rastreio')->nullable()->after('codigo_entrega');
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