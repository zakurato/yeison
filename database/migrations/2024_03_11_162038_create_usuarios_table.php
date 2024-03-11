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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string("cedula");
            $table->string("nombre");
            $table->string("telefono");
            $table->string("direccion");
            $table->string("prestamo");
            $table->string("intereses");
            $table->string("metodoPago");
            $table->string("saldo");
            $table->string("saldoRebajado");
            $table->string("interesesGanados");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
