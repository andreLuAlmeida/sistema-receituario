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
        Schema::create('observacoes', function (Blueprint $table) {
            $table->id();
            $table->text('observacao')->nullable(false);
            $table->timestamp('data_preenchimento')->useCurrent();
            $table->timestamps();
            $table->foreignId('paciente_id')
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
        Schema::dropIfExists('observacoes');
    }
};
