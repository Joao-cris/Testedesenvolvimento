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
        Schema::table('funcionarios', function (Blueprint $table) {
            //
            // Adicionar a coluna 'senha' à tabela 'funcionarios'
        Schema::table('funcionarios', function (Blueprint $table) {
            $table->string('senha')->nullable()->after('email'); // A coluna 'senha' será do tipo string
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('funcionarios', function (Blueprint $table) {
            //
            $table->dropColumn('senha');
        });
    }
};
