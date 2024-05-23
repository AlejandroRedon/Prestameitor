<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase que representa una persona en el sistema de préstamos.
 */
class Persona extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */

    protected $fillable = ['nombre', 'telefono', 'email'];
    
    /**
     * Define la relación uno a muchos con el modelo Prestamo.
     * Una persona puede tener muchos préstamos asociados.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'id_persona');
    }
}