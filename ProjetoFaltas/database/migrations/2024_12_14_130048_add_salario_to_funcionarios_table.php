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

        $table->double('salario', 8, 2)->nullable();  // Adiciona a coluna 'salario' como tipo double

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('funcionarios', function (Blueprint $table) {

            $table->dropColumn('salario');  // Remove a coluna 'salario' caso a migração seja revertida

            //
        });
    }
};
