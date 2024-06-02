<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use Illuminate\Http\Request;

class ObjetoController extends Controller
{
    /**
     * Muestra un listado de los objetos del usuario autenticado.
     *
     * @return \Illuminate\View\View Vista con el listado de objetos.
     */
    public function index()
    {
        $objetos = Objeto::where('user_id', auth()->user()->id)->latest()->paginate(10);
        return view('indexObjeto', ['objetos' => $objetos]);
    }

     /**
     * Muestra el formulario para crear un nuevo objeto.
     *
     * @return \Illuminate\View\View Vista con el formulario de creación de objetos.
     */
    public function create()
    {
        return view('crearObjeto');
    }

     /**
     * Almacena un nuevo objeto en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request Datos del formulario de creación.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la vista de listado de objetos con mensaje de éxito.
     */

    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required',
        'tipo' => 'required'
    ]);

    $objeto = new Objeto($request->all()); // Crear una nueva instancia de Objeto
    $objeto->user_id = auth()->user()->id; // Asignar el ID del usuario autenticado
    $objeto->save(); // Guardar el objeto en la base de datos

    return redirect()->route('objeto.index')->with('success', 'Nuevo objeto añadido.');
}


    /**
     * Display the specified resource.
     */
    public function show(Objeto $objeto)
    {
        //** para futuras versiones */
    }

    /**
     * Muestra el formulario para editar un objeto existente.
     *
     * @param  \App\Models\Objeto  $objeto Modelo del objeto a editar.
     * @return \Illuminate\View\View Vista con el formulario de edición del objeto.
     */
    public function edit(Objeto $objeto)
    {
        if ($objeto->user_id != auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }
        return view ('editarObjeto', ['objeto' => $objeto]);
    }

    /**
     * Actualiza un objeto existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request Datos del formulario de edición.
     * @param  \App\Models\Objeto  $objeto Modelo del objeto a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la vista de listado de objetos con mensaje de éxito.
     */
    public function update(Request $request, Objeto $objeto)
    {
        if ($objeto->user_id != auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'nombre' => 'required',
            'tipo' => 'required'
        ]);

        $objeto->update($request->all());
        return redirect()->route('objeto.index')->with('success', 'Objeto editado.');
    }

    /**
     * Elimina un objeto de la base de datos.
     *
     * @param  \App\Models\Objeto  $objeto Modelo del objeto a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la vista de listado de objetos con mensaje de éxito.
     */
    public function destroy(Objeto $objeto)
    {
        if ($objeto->user_id != auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }
        $objeto->delete();
        return redirect()->route('objeto.index')->with('success', 'Objeto eliminado.');
    }
}
