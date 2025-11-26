<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Mostrar formulario de registro
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Manejar registro de nuevo usuario
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Crear usuario y asignar rol por defecto
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user', // obligatorio si la columna es NOT NULL
            'password' => Hash::make($request->password),
        ]);

        // Disparar evento de usuario registrado
        event(new Registered($user));

        // Loguear automáticamente
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
