<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Prestamo;
use App\Models\Objeto;
use App\Models\Persona;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $personaBase = new Persona();
        $personaBase->id = 1;
        $personaBase->nombre = "Paco García";
        $personaBase->telefono = "646463763";
        $personaBase->email = "pgarcia@latelefonica.com";
        $personaBase->save();

        $objetoBase = new Objeto();
        $objetoBase->id = 1;
        $objetoBase->nombre = "El color de la magia";
        $objetoBase->tipo = "Libro";
        $objetoBase->save();

        $prestamoBase = new Prestamo();
        $prestamoBase->id_objeto = 1;
        $prestamoBase->id_persona = 1;
        $prestamoBase->fecha_prestamo = "2024-05-05 00:00:00";
        $prestamoBase->fecha_a_devolver = "2024-06-01 00:00:00";
        $prestamoBase->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
