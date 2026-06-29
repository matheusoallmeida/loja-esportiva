<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vendas', function (Blueprint $table) {
<<<<<<< HEAD
            $table->string('status_pagamento')->default('pendente');
            $table->string('codigo_pagamento')->nullable();

            $table->string('status_entrega')->default('pendente');
            $table->string('codigo_entrega')->nullable();
            $table->string('codigo_rastreio')->nullable();
=======
            $table->string('status_pagamento')->default('pendente')->after('status');
            $table->string('codigo_pagamento')->nullable()->after('status_pagamento');

            $table->string('status_entrega')->default('pendente')->after('codigo_pagamento');
            $table->string('codigo_entrega')->nullable()->after('status_entrega');
            $table->string('codigo_rastreio')->nullable()->after('codigo_entrega');
>>>>>>> 422371e18e4897bef7cb69ebb84937851c9c8f92
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
<<<<<<< HEAD
};
=======
};
>>>>>>> 422371e18e4897bef7cb69ebb84937851c9c8f92
