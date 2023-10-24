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
        Schema::create('registros_de_dispensa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmacias_id')->constrained('farmacias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('receitas_id')->constrained('receitas')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('data_dispensa');
            $table->longText('conteudo_da_dispensa');
            $table->string('nome_balconista', 100);
            $table->string('crf', 7)->nullable();
            $table->timestamps(); 
            
        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down() : void
    {
        Schema::dropIfExists('registros_de_dispensa');
    }
};