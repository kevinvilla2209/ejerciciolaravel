<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<a href="{{ url('/empleado/create') }}">Registrar nuevo empleado </a>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre/s</th>
            <th>PrimerApel</th>
            <th>SegundoApel</th>
            <th>Correo</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($empleados as $datos)
        <tr>
            <td>{{$datos->id}}</td>
            <td>
                <img src="{{ asset(('storage').'/' . $datos->Foto) }}" alt="Foto Empleado" style="width: 100px; height: auto;">
            </td>            
            <td>{{$datos->Nombres}}</td>
            <td>{{$datos->PrimerApel}}</td>
            <td>{{$datos->SegundoApel}}</td>
            <td>{{$datos->Correo}}</td>
            <td>
                <a href="{{url('/empleado/'.$datos->id. '/edit')}}"> Editar </a>
  
            </td>

            <td>
                <form action="{{url('/empleado/'.$datos->id)}}" method="POST">
                    @csrf
                    {{method_field('DELETE')}}
                    <input type="submit" onclick="return confirm('¿Desea Eliminar?')" value="Eliminar">
                </form>
            </td>
        </tr>    
        @endforeach
    </tbody>
</table>
    
</body>
</html>