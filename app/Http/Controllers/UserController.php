<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request // <-- ACEPTAMOS LA SOLICITUD
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Obtener el término de búsqueda de la URL (ej: /users?search=Fabian)
        $search = $request->input('search');

        // Inicializar la consulta al modelo User
        $query = User::query();

        // Aplicar el filtro SI se proporciona un término de búsqueda
        if ($search) {
            $query->where(function ($q) use ($search) {
                // Filtrar por nombre O por email
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('email', 'LIKE', '%' . $search . '%');
            });
        }

        // Obtener los usuarios paginados basados en la consulta filtrada
        $users = $query->paginate(10);
        
        // Mantener el término de búsqueda en los enlaces de paginación
        $users->appends(['search' => $search]); 

        // Retornar la vista, pasando los usuarios paginados
        return view('users.index', compact('users', 'search'));
    }

    public function create()
    {
        // Devolver la vista con el formulario de creación.
        return view('users.create'); 
    }
/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. VALIDACIÓN
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Asegura que el email sea único
            'password' => 'required|string|min:8|confirmed', // 'confirmed' busca un campo llamado 'password_confirmation'
        ]);

        // 2. CREACIÓN DEL USUARIO
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Usar Hash::make para encriptar la contraseña
        ]);

        // 3. REDIRECCIÓN Y MENSAJE DE ÉXITO
        return redirect()->route('users.index')
                         ->with('success', 'Usuario creado exitosamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // Devolver la vista de edición, pasando la instancia del usuario.
        return view('users.edit', compact('user')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // 1. VALIDACIÓN
        $request->validate([
            'name' => 'required|string|max:255',
            
            // Regla crucial: el email debe ser único, PERO IGNORANDO el email actual del usuario ($user->id)
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            
            // La contraseña es opcional, pero si se envía, debe cumplir los requisitos y confirmarse.
            'password' => 'nullable|string|min:8|confirmed', 
        ]);

        // 2. ACTUALIZACIÓN DE DATOS (EXCLUYENDO LA CONTRASEÑA)
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        // 3. ACTUALIZACIÓN CONDICIONAL DE CONTRASEÑA
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // 4. REDIRECCIÓN Y MENSAJE DE ÉXITO
        return redirect()->route('users.index')
                         ->with('success', 'Usuario actualizado exitosamente.');
    }

/**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // 1. ELIMINAR EL USUARIO
        // Laravel usa Route Model Binding, por lo que la variable $user
        // ya es una instancia del modelo App\Models\User.
        $user->delete();

        // 2. REDIRECCIÓN Y MENSAJE DE ÉXITO
        return redirect()->route('users.index')
                         ->with('success', 'Usuario eliminado exitosamente.');
    }
}
