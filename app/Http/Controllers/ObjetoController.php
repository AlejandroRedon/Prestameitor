<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use Illuminate\Http\Request;

class ObjetoController extends Controller
{
    /**
     * Muestra un listado de los objetos.
     *
     * @return \Illuminate\View\View Vista con el listado de objetos.
     */
    public function index()
    {
        $objetos = Objeto::latest()->paginate(10);

        return view ('indexObjeto', ['objetos' => $objetos]);
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

        Objeto::create($request->all());
        return redirect()->route('objeto.index')->with('success', 'Nueva objeto añadida.');
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
        $objeto->delete();
        return redirect()->route('objeto.index')->with('success', 'Objeto eliminado.');
    }
}
