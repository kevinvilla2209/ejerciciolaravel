Formulario que tendrá los datos para crear o actualizar los empleados <br>

<input type="text" name="Nombres" placeholder="Nombre/s" value="{{ $empleado->Nombres ?? '' }}"><br><br>
<input type="text" name="PrimerApel" placeholder="Primer Apellido" value="{{ $empleado->PrimerApel ?? '' }}"><br><br>
<input type="text" name="SegundoApel" placeholder="Segundo Apellido" value="{{ $empleado->SegundoApel ?? '' }}"><br><br>
<input type="text" name="Correo" placeholder="Correo" value="{{ $empleado->Correo ?? '' }}"><br><br>
<input type="file" name="Foto"><br><br>

@if(isset($empleado->Foto))
    <img src="{{ asset('storage/' . $empleado->Foto) }}" alt="Foto Empleado" style="width: 100px; height: auto;">
@endif

<input type="submit" value="Actualizar">