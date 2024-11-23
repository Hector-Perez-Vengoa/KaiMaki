<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EstadoUsers;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function cambiarEstado($id)
    {
        // Buscar el usuario por su ID con su estado actual
        $usuario = User::with('estado')->findOrFail($id);

        // Obtener todos los estados disponibles
        $estados = EstadoUsers::all();

        // Retornar la vista con los datos del usuario y los estados
        return view('administrador.cambiarEstado', compact('usuario', 'estados'));
    }
    
    public function actualizarEstado(Request $request, $id)
    {
        // Validar el estado proporcionado
        $request->validate([
            'id_estado_users' => 'required|exists:estado_users,id_estado_users',
        ]);

        // Buscar el usuario por su ID
        $usuario = User::findOrFail($id);

        // Actualizar el estado del usuario
        $usuario->id_estado_users = $request->id_estado_users;
        $usuario->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('administrador.trabajador')
            ->with('success', 'El estado del usuario se actualizó correctamente.');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
