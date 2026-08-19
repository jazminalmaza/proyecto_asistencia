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
        Schema::create('materia', function (Blueprint $table) {
            $table->id('id_materia');
            $table->string('nombre' , 70);
            $table->string('turno' , 20);
            $table->string('curso' , 10);
            $table->time('horario_inicio');
            $table->time('horario_finalizacion');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('materia');
    }
};