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
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->boolean('aprovado')->default(false);
            $table->string('crm', 10)->nullable(false);
            $table->string('especialidade', 100)->nullable(false);
            $table->string('cpf', 15)->nullable(false);
            $table->string('rg', 15)->nullable(true);
            $table->string('data_nascimento', 45)->nullable(false);
            $table->string('telefone', 15)->nullable(true);
            $table->string('celular', 45)->nullable(true);
            $table->string('cep', 9)->nullable(false);
            $table->string('estado', 17)->nullable(false);
            $table->string('cidade', 100)->nullable(false);
            $table->string('bairro', 100)->nullable(false);
            $table->string('rua', 100)->nullable(false);
            $table->string('qrcode_assinatura', 300)->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
