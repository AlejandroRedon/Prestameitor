<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Objeto;
use App\Models\Persona;
use Illuminate\Http\Request;


class PrestamoController extends Controller
{
    /**
     * Muestra un listado de los préstamos del usuario autenticado.
     *
     * @return \Illuminate\View\View Vista con el listado de préstamos.
     */
    public function index()
    {
        $prestamos = Prestamo::with('persona', 'objeto')
            ->where('user_id', auth()->user()->id) // Filtrar por user_id
            ->latest()
            ->paginate(10);

        return view('indexPrestamo', ['prestamos' => $prestamos]);
    }

    /**
     * Muestra el formulario para crear un nuevo préstamo.
     *
     * @return \Illuminate\View\View Vista con el formulario de creación de préstamos.
     */
    public function create()
    {
        $objetos = Objeto::latest()->get();
        $personas = Persona::latest()->get();

        return view('crearPrestamo', ['objetos' => $objetos, 'personas' => $personas]);
    }

    /**
     * Almacena un nuevo préstamo en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request Datos del formulario de creación.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la vista de listado de préstamos con un mensaje de éxito.
     */
    public function store(Request $request)
    {
    // Convertir las fechas de dd/mm/yyyy a Y-m-d
    $fechaPrestamo = \DateTime::createFromFormat('d/m/Y', $request->fecha_prestamo);
    $fechaDevolucion = \DateTime::createFromFormat('d/m/Y', $request->fecha_a_devolver);

    // Validar las fechas convertidas
    $request->merge([
        'fecha_prestamo' => $fechaPrestamo ? $fechaPrestamo->format('Y-m-d') : null,
        'fecha_a_devolver' => $fechaDevolucion ? $fechaDevolucion->format('Y-m-d') : null,
    ]);

    $request->validate([
        'id_objeto' => 'required',
        'id_persona' => 'required',
        'fecha_prestamo' => 'required|date',
        'fecha_a_devolver' => 'required|date|after_or_equal:fecha_prestamo',
    ], [
        'id_objeto.required' => 'El objeto es obligatorio.',
        'id_persona.required' => 'La persona es obligatoria.',
        'fecha_prestamo.required' => 'La fecha de préstamo es obligatoria.',
        'fecha_prestamo.date' => 'La fecha de préstamo debe tener un formato de fecha válido.',
        'fecha_a_devolver.required' => 'La fecha de devolución es obligatoria.',
        'fecha_a_devolver.date' => 'La fecha de devolución debe tener un formato de fecha válido.',
        'fecha_a_devolver.after_or_equal' => 'La fecha de devolución debe ser igual o posterior a la fecha de préstamo.'
    ]);

    // Crear una instancia para el nuevo préstamo
    $nuevoPrestamo = new Prestamo;
    $nuevoPrestamo->id_objeto = $request->id_objeto;
    $nuevoPrestamo->id_persona = $request->id_persona;
    $nuevoPrestamo->user_id = auth()->user()->id; // Asignar el ID del usuario autenticado
    $nuevoPrestamo->fecha_prestamo = $request->fecha_prestamo;
    $nuevoPrestamo->fecha_a_devolver = $request->fecha_a_devolver;

        // Guardamos en la BD
        $nuevoPrestamo->save();

        return redirect()->route('index')->with('success', 'Nuevo prestamo añadido.');

    }

    
    public function show(Prestamo $prestamo)
    {
        //para futuras versiones
    }

    
    public function edit(Prestamo $prestamo)
    {
       //para futuras versiones
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestamo $prestamo)
    {
        //para futuras versiones
    }

     /**
     * Elimina un préstamo de la base de datos.
     *
     * @param  \App\Models\Prestamo  $prestamo Modelo del préstamo a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la vista de listado de préstamos con un mensaje de éxito.
     */
    public function destroy(Prestamo $prestamo)
    {
        if ($prestamo->user_id != auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }
        $prestamo->delete();
        return redirect()->route('index')->with('success', 'Prestamo eliminada.');
    }
}
