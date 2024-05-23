@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2>Editar persona</h2>
        </div>
        <div>
            <a href="{{route('persona.index')}}" class="btn btn-primary">Volver</a>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Se ha producido un error.</strong><br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{route('persona.update', $persona)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Nombre:</strong>
                    <input type="text" name="nombre" class="form-control"
                    placeholder="Introduce el nombre de la persona. campo obligatorio" 
                    value="{{$persona->nombre}}">
                    <strong>Teléfono:</strong>
                    <input type="text" name="telefono" class="form-control"
                    placeholder="Introduce el teléfono de la persona." 
                    value="{{$persona->telefono}}">
                    <strong>eMail:</strong>
                    <input type="text" name="email" class="form-control"
                    placeholder="Introduce el eMail de la persona.(campo obligatorio)" 
                    value="{{$persona->email}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-primary">Editar persona</button>
            </div>
        </div>
    </form>
</div>
@endsection