@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2>Crear objeto</h2>
        </div>
        <div>
            <a href="{{route('objeto.index')}}" class="btn btn-primary">Volver</a>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Se ha producido un error:</strong><br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif  

    <form action="{{route('objeto.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Nombre:</strong>
                    <input type="text" name="nombre" class="form-control"
                    placeholder="Introduce el nombre del objeto.">
                    <strong>Tipo:</strong>
                    <input type="text" name="tipo" class="form-control"
                    placeholder="Introduce el tipo de objeto.">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-primary">Crear objeto</button>
            </div>
        </div>
    </form>
</div>
@endsection