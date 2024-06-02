<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Muestra un listado de las personas.
     *
     * @return \Illuminate\View\View Vista con el listado de personas.
     */
    public function index()
    {
        $personas = Persona::where('user_id', auth()->user()->id)->latest()->paginate(10);
        return view('indexPersona', ['personas' => $personas]);
    }

     /**
     * Muestra el formulario para crear una nueva persona.
     *
     * @return \Illuminate\View\View Vista con el formulario de creación de personas.
     */
    public function create()
    {
        return view('crearPersona');
    }

     /**
     * Almacena una nueva persona en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request Datos del formulario de creación.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la vista de listado de personas con un mensaje de éxito.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:50',
            'email' => 'required|email',
            'telefono' => 'nullable|regex:/^[0-9]{0,10}$/'
        ], [
            'email.required' => 'El campo de email no puede estar vacío.',
            'email.email' => 'Debe ingresar un email válido.'
        ]);
    
        $persona = new Persona($request->all()); // Crear una nueva instancia de Persona
        $persona->user_id = auth()->user()->id; // Asignar el ID del usuario autenticado
        $persona->save(); // Guardar la persona en la base de datos
    
        return redirect()->route('persona.index')->with('success', 'Nueva persona añadida.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Persona $persona)
    {
        
    }

  /**
     * Muestra el formulario para editar una persona existente si pertenece al usuario autenticado.
     *
     * @param  \App\Models\Persona  $persona Modelo de la persona a editar.
     * @return \Illuminate\View\View|\Illuminate\Http\Response Vista con el formulario de edición de la persona o respuesta de error 403.
     */
    public function edit(Persona $persona)
    {
        if ($persona->user_id != auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }
        return view('editarPersona', ['persona' => $persona]);
    }


    /**
     * Actualiza una persona existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request Datos del formulario de edición.
     * @param  \App\Models\Persona  $persona Modelo de la persona a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la vista de listado de personas con un mensaje de éxito.
     */
    public function update(Request $request, Persona $persona)
    {
        if ($persona->user_id != auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'nombre' => 'required|max:50',
            'email' => 'required|email',
            'telefono' => 'nullable|regex:/^[0-9]{0,10}$/'
        ], [
            'email.required' => 'El campo de email no puede estar vacío.',
            'email.email' => 'Debe ingresar un email válido.'
        ]);
    
        $persona->update($request->all());
        return redirect()->route('persona.index')->with('success', 'Persona editada.');
    }

    /**
     * Elimina una persona de la base de datos.
     *
     * @param \App\Models\Persona $persona Modelo de la persona a eliminar
     * @return \Illuminate\Http\RedirectResponse Redirecciona al listado con un mensaje de éxito o error
     */

     public function destroy(Persona $persona)
     {
        if ($persona->user_id != auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }
         // Verificar si la persona tiene préstamos asociados
         if ($persona->prestamos()->count() > 0) {
             // Redirigir con un mensaje de error
             return redirect()->route('persona.index')->withErrors('No se puede eliminar una persona con préstamos asociados.');
         }
     
         // Si no tiene préstamos, proceder a eliminar
         $persona->delete();
         return redirect()->route('persona.index')->with('success', 'Persona eliminada.');
     }

}
