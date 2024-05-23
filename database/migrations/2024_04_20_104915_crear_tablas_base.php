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
        // Se crean las tablas que vamos a usar en nuestra aplicación

        Schema::create('objetos', function (Blueprint $objeto) {
            $objeto->id();
            $objeto->string('nombre');
            $objeto->string('tipo');
            $objeto->timestamps();          
        });

        Schema::create('personas', function (Blueprint $persona) {
            $persona->id();
            $persona->string('nombre');
            $persona->string('telefono')->nullable();
            $persona->string('email')->nullable();
            $persona->timestamps();
        });
   
        Schema::create('prestamos', function (Blueprint $prestamo) {
            $prestamo->id();
            $prestamo->unsignedBigInteger('id_objeto')->nullable();
            $prestamo->unsignedBigInteger('id_persona')->nullable();
            $prestamo->dateTime('fecha_prestamo');
            $prestamo->dateTime('fecha_a_devolver');
            $prestamo->timestamps();

            $prestamo->foreign('id_objeto')
            ->references('id')->on('objetos')
            ->onDelete('set null'); 
            $prestamo->foreign('id_persona')
            ->references('id')->on('personas')
            ->onDelete('set null'); 
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Borrar las tablas

        Schema::dropIfExists('prestamo');
        Schema::dropIfExists('persona');
        Schema::dropIfExists('objeto');
    }
};
