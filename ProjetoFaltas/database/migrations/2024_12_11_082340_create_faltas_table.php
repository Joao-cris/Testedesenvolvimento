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
        Schema::create('faltas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funcionario_id')->constrained()->onDelete('cascade'); // chave estrangeira para o funcionário
            $table->date('data_inicio'); // data de início da falta
            $table->date('data_fim'); // data de fim da falta
            $table->string('tipo_falta'); // tipo da falta (por exemplo: "doença", "atraso", etc.)
            $table->string('justificada'); // se a falta foi justificada ("sim" ou "não")
            $table->text('comentario')->nullable(); // comentário sobre a falta, pode ser nulo
            $table->string('justificativo_arquivo')->nullable(); // caminho para o arquivo justificativo, pode ser nulo
            $table->timestamps(); // timestamps padrão (created_at, updated_at)

            // Definindo chave estrangeira
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faltas');
    }
};
