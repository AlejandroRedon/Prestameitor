<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase que representa un objeto en el sistema de préstamos.
 */
class Objeto extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */

    protected $fillable = ['nombre', 'tipo'];

    /**
     * Define la relación uno a muchos con el modelo Prestamo.
     * Un objeto puede tener muchos préstamos asociados.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'id_objeto');
    }
    
}