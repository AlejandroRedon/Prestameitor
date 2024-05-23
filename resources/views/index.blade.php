

@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-white">Prestameitor</h2>
        </div>
        <nav class="navbar navbar-dark bg-dark">
            <form class="form-inline">
                <a href="{{ route('persona.index') }}" class="btn btn-success">Gestionar personas</a>
                <a href="{{ route('objeto.index') }}" class="btn btn-success">Gestionar objetos</a>
                <a href="{{ route('prestamo.create') }}" class="btn btn-primary">Crear nuevo préstamo</a>
            </form>
        </nav>
    </div>
    
    @if (Session::get('success'))
        <div class="alert alert-success col-4">
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger col-4">
            <strong>{{ $errors->first() }}</strong>
        </div>
    @endif

    <div class="col-12 mt-4">
        <table class="table table-bordered text-white">
            <tr class="text-secondary">
                <th>Objeto (Tipo)</th>
                <th>Persona (Teléfono / Mail)</th>
                <th>Fecha préstamo</th>
                <th>Fecha devolución</th>
                <th>Acciones</th>
            </tr>
            @foreach ($prestamos as $prestamo)
                <tr>
                    <td class="fw-bold">
                        {{ $prestamo->objeto->nombre ?? 'Objeto no encontrado' }} 
                        ({{ $prestamo->objeto->tipo ?? 'Tipo no encontrado' }})
                    </td>
                    <td>
                        {{ $prestamo->persona->nombre ?? 'Persona no encontrada' }} <br>
                        {{ $prestamo->persona->telefono ?? 'Teléfono no encontrado' }} <br>
                        {{ $prestamo->persona->email ?? 'Email no encontrado' }}
                    </td>
                    <td>{{ date_format(date_create($prestamo->fecha_prestamo), "d-m-Y") }}</td>
                    <td class="fw-bold">{{ date_format(date_create($prestamo->fecha_a_devolver), "d-m-Y") }}</td>
                    <td>
                        <form action="{{ route('prestamo.destroy', $prestamo) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
