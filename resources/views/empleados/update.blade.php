FORMULARIO PARA ACTUALIZAR LOS DATOS DE LOS EMPLEADOS

<form action="{{ url('/empleado/' . $empleado->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    @include('empleados.form', ['empleado' => $empleado])
</form>

