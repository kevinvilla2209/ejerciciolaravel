Formulario que tendrá los datos para crear o actualizar los empleados <br>

<h1>{{$modo}} Empleados </h1>

<input type="text" name="Nombres" placeholder="Nombre/s" value="{{ old('Nombres', $empleado->Nombres ?? '') }}"><br><br>
<input type="text" name="PrimerApel" placeholder="Primer Apellido" value="{{ old('PrimerApel', $empleado->PrimerApel ?? '') }}"><br><br>
<input type="text" name="SegundoApel" placeholder="Segundo Apellido" value="{{ old('SegundoApel', $empleado->SegundoApel ?? '') }}"><br><br>
<input type="text" name="Correo" placeholder="Correo" value="{{ old('Correo', $empleado->Correo ?? '') }}"><br><br>
<input type="file" name="Foto"><br><br>

@if(isset($empleado->Foto))
    <img src="{{ asset('storage/' . $empleado->Foto) }}" alt="Foto Empleado" style="width: 100px; height: auto;">
@endif

<input type="submit" value="{{$modo}} Registro">

@if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

