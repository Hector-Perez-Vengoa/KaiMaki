<?php

namespace App\Http\Controllers;

use App\Models\Reclamos;
use App\Notifications\ReclamoNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class ReclamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */

        // Mostrar el formulario de registro de reclamos
        public function create()
        {
            $userId = Auth::id();

            // Obtener los reclamos del usuario autenticado
            $reclamos = Reclamos::where('id_usuario', $userId)
                ->with('estado')
                ->orderBy('fech_reclamo', 'desc')
                ->get();

            // Verificar el rol del usuario y cargar la vista correspondiente
            $user = Auth::user(); // Obtener el usuario autenticado
            if ($user->id_roles == 2) {
                return view('trabajador.reclamo.create', compact('reclamos'));
            } elseif ($user->id_roles == 3) {
                return view('cliente.reclamo.create', compact('reclamos'));
            }

            // Si el rol no coincide, redirigir a una página de error
            return abort(403, 'No autorizado');
        }



    // Registrar el reclamo en la base de datos
    public function store(Request $request)
{
    $userId = Auth::id();

    // Validar los datos del formulario
    $request->validate([
        'asunto' => 'required|max:100',
        'descripcion' => 'required|max:500',
    ]);

    // Crear el reclamo
    $reclamo = Reclamos::create([
        'asunto' => $request->input('asunto'),
        'descripcion' => $request->input('descripcion'),
        'fech_reclamo' => now(),
        'id_usuario' => $userId, // Relacionar con el usuario autenticado
        'id_estado_reclamo' => 2, // Estado inicial (por ejemplo, "Pendiente")
    ]);

    // Enviar notificación al administrador
    $adminUsers = User::where('id_roles', 1)->get(); // Suponiendo que el rol '1' es para administradores
    foreach ($adminUsers as $admin) {
        $admin->notify(new ReclamoNotification($reclamo));
    }

    // Redirigir según el rol del usuario autenticado
    $user = Auth::user();
    if ($user->id_roles == 3) {
        return redirect()->route('cliente.reclamo.create')->with('success', '¡Reclamo registrado exitosamente!');
    } elseif ($user->id_roles == 2) {
        return redirect()->route('trabajador.reclamo.create')->with('success', '¡Reclamo registrado exitosamente!');
    }
}


    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
