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
        Schema::table('prestamos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Agregar la columna user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Agregar la clave foránea
        });
    }
    
    public function down(): void
    {
        Schema::table('prestamos', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Eliminar la clave foránea
            $table->dropColumn('user_id'); // Eliminar la columna user_id
        });
    }
};
