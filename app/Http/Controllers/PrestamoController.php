<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Objeto;
use App\Models\Persona;
use Illuminate\Http\Request;


class PrestamoController extends Controller
{
    /**
     * Muestra un listado de los préstamos, incluyendo información de la persona y el objeto relacionados.
     *
     * @return \Illuminate\View\View Vista con el listado de préstamos.
     */
    
     public function index()
     {
         $prestamos = Prestamo::with('persona', 'objeto')->latest()->paginate(10);
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
        $request->validate([
            'id_objeto' => 'required',
            'id_persona' => 'required',
            'fecha_prestamo' => 'required',
            'fecha_a_devolver' => 'required'
        ]);

        // Creamos una instancia para el nuevo prestamo
        $nuevoPrestamo = new Prestamo;

        // Añadimos los valores convertidos
        $nuevoPrestamo->id_objeto = $request->id_objeto;
        $nuevoPrestamo->id_persona = $request->id_persona;

        // Al cambiar el tipo de separación de fechas, se entienden como europeas
        $conversionDate = str_replace('/', '-', $request->fecha_prestamo);
        $nuevoPrestamo->fecha_prestamo = date('Y-m-d', strtotime($conversionDate));
        $conversionDate = str_replace('/', '-', $request->fecha_a_devolver);
        $nuevoPrestamo->fecha_a_devolver = date('Y-m-d', strtotime($conversionDate));

        // Guardamos en la BD
        $nuevoPrestamo->save();

        return redirect()->route('prestamo.index')->with('success', 'Nuevo prestamo añadido.');
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
        $prestamo->delete();
        return redirect()->route('prestamo.index')->with('success', 'Prestamo eliminada.');
    }
}
