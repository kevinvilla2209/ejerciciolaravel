<?php

namespace App\Http\Controllers;

use App\Models\empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    // Obtener los empleados con paginación de 5
    $empleados = Empleado::paginate(5);
    
    // Pasar los empleados a la vista
    return view('empleados.index', compact('empleados'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Definimos las reglas de validación
    $validacion = [
        'Nombres' => 'required|string|max:90',
        'PrimerApel' => 'required|string|max:90',
        'SegundoApel' => 'nullable|string|max:90',  // Segundo Apellido no es obligatorio
        'Correo' => 'required|string|max:90',
        'Foto' => 'required|image|max:2048',  // Foto obligatoria y debe ser una imagen
    ];

    // Definimos los mensajes de error personalizados
    $msj = [
        'required' => 'El :attribute es requerido',
        'Foto.required' => 'La Foto es requerida',
    ];

    // Ejecutamos la validación con el objeto $request
    $request->validate($validacion, $msj);

    // Tomamos los datos del formulario, excluyendo el token de CSRF
    $datosEmpleado = $request->except('_token');

    // Verificamos si se ha subido una foto y la almacenamos
    if ($request->hasFile('Foto')) {
        $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads', 'public');
    }

    // Insertamos los datos del empleado en la base de datos
    empleado::insert($datosEmpleado);

    // Redirigimos con un mensaje de éxito
    return redirect('empleado')->with('mensaje', 'Registro ingresado con éxito');
}

    /**
     * Display the specified resource.
     */
    public function show(empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $empleado = empleado::findOrFail($id);
        return view('empleados.update', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    // Definimos las reglas de validación
    $validacion = [
        'Nombres' => 'required|string|max:90',
        'PrimerApel' => 'required|string|max:90',
        'SegundoApel' => 'nullable|string|max:90',
        'Correo' => 'required|string|max:90',
        'Foto' => 'nullable|image',
    ];

    // Definimos los mensajes personalizados
    $msj = [
        'required' => 'El :attribute es requerido',
    ];

    // Si se ha subido una nueva foto, añadimos reglas de validación adicionales
    if ($request->hasFile('Foto')) {
        $validacion['Foto'] = 'image|max:10000|mimes:jpg,png,jpeg';

        // Añadimos los mensajes personalizados para foto
        $msj['Foto.max'] = 'La foto no debe pesar más de 10MB.';
        $msj['Foto.mimes'] = 'La foto debe ser un archivo de tipo: jpg, png, jpeg.';
    }

    // Ejecutamos la validación usando $request->validate() en lugar de $this->validate()
    $request->validate($validacion, $msj);

    // Tomamos los datos del formulario, excluyendo el token de CSRF y el método PUT
    $datos = $request->except(['_token', '_method']);

    // Si se ha subido una nueva foto, procesamos la foto
    if ($request->hasFile('Foto')) {
        // Lógica para eliminar la foto antigua (requiere usar Storage)
        $empleadoActual = empleado::findOrFail($id);
        if ($empleadoActual->Foto) {
            // Eliminar la foto anterior desde el disco 'public'
            \Illuminate\Support\Facades\Storage::disk('public')->delete($empleadoActual->Foto);
        }

        // Guardamos la nueva foto
        $datos['Foto'] = $request->file('Foto')->store('uploads', 'public');
    }

    // Actualizamos los datos del empleado en la base de datos
    empleado::where('id', '=', $id)->update($datos);

    // Obtenemos el empleado actualizado para mostrar en la vista
    $empleado = empleado::findOrFail($id);

    // Redirigimos al empleado con el mensaje de éxito
    return redirect('empleado')->with('mensaje','Registro actualizado con éxito');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $empleado = empleado::findOrFail($id);
        if(Storage::delete('public/'.$empleado->Foto)){
            empleado::destroy($id);
        }
        
        return redirect('empleado')->with('mensaje', 'Registro eliminado con éxito');
    }

}
