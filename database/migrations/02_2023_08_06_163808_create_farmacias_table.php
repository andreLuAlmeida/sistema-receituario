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
        Schema::create('farmacias', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj', 14)->nullable(false);
            $table->string('telefone', 15)->nullable(true);
            $table->string('celular', 45)->nullable(true);
            $table->string('cep', 9)->nullable(false);
            $table->string('estado', 17)->nullable(false);
            $table->string('cidade', 100)->nullable(false);
            $table->string('bairro', 100)->nullable(false);
            $table->string('rua', 100)->nullable(false);
            $table->string('numero', 9)->nullable(false);
            $table->string('qrcode_assinatura', 300)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmacias');
    }
};
