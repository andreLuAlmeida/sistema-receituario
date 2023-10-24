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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('sobrenome', 100);
            $table->string('cpf', 15);
            $table->string('data_nascimento', 45);
            $table->integer('idade');
            $table->string('sexo', 45);
            $table->string('profissao', 100);
            $table->string('rg', 15)->nullable();
            $table->string('email', 320)->nullable();
            $table->string('telefone', 15)->nullable();
            $table->string('celular', 45)->nullable();
            $table->string('cep', 9);
            $table->string('estado', 17);
            $table->string('cidade', 100);
            $table->string('bairro', 100);
            $table->string('rua', 100);
            $table->string('numero_residencial', 10);

            $table->foreignId('medicos_id')->constrained('medicos')->onDelete('cascade')->onUpdate('cascade');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
