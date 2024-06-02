@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2>Crear prestamo</h2>
        </div>
        <div>
            <a href="{{ route('index') }}" class="btn btn-primary">Volver</a>
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

    <form action="{{route('prestamo.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 pt-3">
                <div class="form-group">
                    <strong>Objeto:</strong>
                    <select name="id_objeto" id="id_objeto" class="form-control">
                    @foreach ($objetos as $objeto)
                        <option value="{{$objeto->id}}">{{$objeto->nombre}} ({{$objeto->tipo}})</option>
                    @endforeach
                    </select>
                    <br><br>
                    <strong>Persona:</strong>
                    <select name="id_persona" id="id_persona" class="form-control">
                    @foreach ($personas as $persona)
                        <option value="{{$persona->id}}">{{$persona->nombre}}</option>
                    @endforeach
                    </select>
                    <br><br>
                    <strong>Fecha préstamo:</strong>
                    <input type="text" class="form-control datepicker" name="fecha_prestamo">
                    </div>
                    <br>
                    <strong>Fecha de devolución estimada:</strong>
                    <input type="text" class="form-control datepicker" name="fecha_a_devolver">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-primary">Crear prestamo</button>
            </div>
        </div>
    </form>
</div>
<script>
    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true
    });
</script>
@endsection