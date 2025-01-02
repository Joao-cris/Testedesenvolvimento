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
        Schema::table('faltas', function (Blueprint $table) {
            $table->integer('countfaltas')->default(0); // Adiciona a nova coluna 'countfaltas' com valor padrão 0

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faltas', function (Blueprint $table) {
            $table->dropColumn('countfaltas'); // Remove a coluna caso a migração seja revertida

        });
    }
};
