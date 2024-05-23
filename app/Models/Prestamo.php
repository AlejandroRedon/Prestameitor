<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Clase que representa un préstamo en el sistema.
 */
class Prestamo extends Model
{
    use HasFactory;

    /**
     * Define la relación de pertenencia con el modelo Persona.
     * Un préstamo pertenece a una persona.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    /**
     * Define la relación de pertenencia con el modelo Objeto.
     * Un préstamo pertenece a un objeto.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function objeto()
    {
        return $this->belongsTo(Objeto::class, 'id_objeto');
    }
}
