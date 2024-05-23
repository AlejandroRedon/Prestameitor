@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-white">Listado de personas</h2>
        </div>
        <nav class="navbar navbar-dark bg-dark">
        <form class="form-inline">
            <a href="{{URL::to('/');}}" class="btn btn-success">Volver</a>
            <a href="{{route('persona.create')}}" class="btn btn-primary">Crear nueva persona</a>
        </form>
        </nav>
    </div>

    @if (Session::get('success'))
    <div class="alert alert-success col-4">
        <strong>{{Session::get('success')}}</strong>
    </div>
    @endif

    <div class="col-12 mt-4">
        <table class="table table-bordered text-white">
            <tr class="text-secondary">
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>eMail</th>
                <th>Acción</th>
            </tr>
            @foreach ($personas as $persona)
            <tr>
                <td class="fw-bold">{{$persona->nombre}}</td>
                <td class="fw-bold">{{$persona->telefono}}</td>
                <td class="fw-bold">{{$persona->email}}</td>
                <td>
                    <a href="{{route('persona.edit', $persona)}}" class="btn btn-warning">Editar</a>

                    <form action="{{route('persona.destroy', $persona)}}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{$personas->links()}}
    </div>
</div>
@endsection