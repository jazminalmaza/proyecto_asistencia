<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id('id_asistencia');
            $table->date('fecha')->nullable();
            $table->string('nombre_docente')->nullable();
            $table->string('materia')->nullable();
            $table->string('turno')->nullable();
            $table->time('hora_ingreso')->nullable();
            $table->time('hora_egreso')->nullable();
            $table->string('estado')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};