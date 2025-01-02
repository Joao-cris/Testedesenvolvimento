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
            //
            $table->string('aprovacao')->nullable(); // Adiciona a coluna 'aprovacao'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faltas', function (Blueprint $table) {

            $table->dropColumn('aprovacao'); // Remove a coluna 'aprovacao' caso a migração seja revertida
            //
        });
    }
};
