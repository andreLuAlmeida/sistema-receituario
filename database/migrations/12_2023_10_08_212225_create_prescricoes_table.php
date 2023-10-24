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
        Schema::create('prescricoes', function (Blueprint $table) {
            $table->id();
            $table->string('via_administracao');
            $table->string('nome_medicamento');
            $table->string('dose');
            $table->string('forma_farmaceutica');
            $table->string('quantidade_total');
            $table->string('frequencia_administracao');
            $table->string('duracao_tratamento');
            $table->text('instrucoes_cuidados')->nullable();
            $table->text('horario')->nullable();
            $table->string('intervalo_tempo')->nullable();
            $table->string('quantidade_doses')->nullable();
            $table->text('outras_orientacoes')->nullable();
            $table->timestamps();
            $table->foreignId('receita_id')
                            ->constrained()
                            ->onUpdate('cascade')
                            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescricoes');
    }
};
