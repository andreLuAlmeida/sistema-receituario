<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     */
    public function up() : void
    {
        Schema::create('receitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicos_id')->constrained('medicos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pacientes_id')->constrained('pacientes')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('prescricao');
            $table->dateTime('data_prescricao');
            $table->string('qrcode_assinatura', 300)->nullable();
            $table->timestamps();

               });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down() : void
    {
        Schema::dropIfExists('receitas');
    }
};