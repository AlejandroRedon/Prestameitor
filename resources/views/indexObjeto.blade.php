@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-white">Listado de objetos</h2>
        </div>
        <nav class="navbar navbar-dark bg-dark">
        <form class="form-inline">
            <a href="{{URL::to('/');}}" class="btn btn-success">Volver</a>
            <a href="{{route('objeto.create')}}" class="btn btn-primary">Crear nuevo objeto</a>
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
                <th>Tipo</th>
                <th>Acción</th>
            </tr>
            @foreach ($objetos as $objeto)
            <tr>
                <td class="fw-bold">{{$objeto->nombre}}</td>
                <td class="fw-bold">{{$objeto->tipo}}</td>
                <td>
                    <a href="{{route('objeto.edit', $objeto)}}" class="btn btn-warning">Editar</a>

                    <form action="{{route('objeto.destroy', $objeto)}}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{$objetos->links()}}
    </div>
</div>
@endsection