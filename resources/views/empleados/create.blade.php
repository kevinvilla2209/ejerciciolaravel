<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creacion de empleados</title>
</head>
<body>
@extends('layouts.app')
@section('content')

<div class="container">

    <form action="{{ url('/empleado') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('empleados.form',['modo'=>'Guardar'])
    </form>

</div>
@endsection
</body>
</html>