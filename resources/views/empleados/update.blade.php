FORMULARIO PARA ACTUALIZAR LOS DATOS DE LOS EMPLEADOS

@extends('layouts.app')
@section('content')

<div class="container">

<form action="{{ url('/empleado/' . $empleado->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    @include('empleados.form', ['modo'=>'Actualizar'])
</form>

</div>
@endsection

