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
    public function index(Request $request)
    {
        // Construir la consulta con las relaciones necesarias
        $query = User::with(['rol', 'trabajadores', 'clientes', 'estado']);

        // Filtro por rol
        if ($request->filled('role')) {
            $query->whereHas('rol', function ($query) use ($request) {
                $query->where('nombre', $request->role);
            });
        }

        // Filtro por DNI
        if ($request->filled('dni')) {
            $query->whereHas('trabajadores', function ($query) use ($request) {
                $query->where('dni', $request->dni);
            })->orWhereHas('clientes', function ($query) use ($request) {
                $query->where('dni', $request->dni);
            });
        }

        // Paginación (10 registros por página)
        $usuariosPaginated = $query->paginate(6);

        // Transformar los datos de cada usuario
        $usuariosPaginated->setCollection(
            $usuariosPaginated->getCollection()->map(function ($usuario) {
                return [
                    'id' => $usuario->id,
                    'rol' => $usuario->rol->nombre ?? 'Sin Rol',
                    'dni' => optional($usuario->trabajadores)->dni ?? optional($usuario->clientes)->dni ?? 'No definido',
                    'nombre' => optional($usuario->trabajadores)->nombres ?? optional($usuario->clientes)->nom_cliente ?? $usuario->name,
                    'estado' => optional($usuario->estado)->nombre_estado ?? 'No definido',
                    'correo' => $usuario->email,
                ];
            })
        );

        return view('administrador.usuarios.usuarios', compact('usuariosPaginated'));
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
