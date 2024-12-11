<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\Negociacion;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MensajeriaController extends Controller
{
      // Mostrar los mensajes de una negociación
    public function index($idNegociacion)
    {
        $userId = Auth::id();
        $user = Auth::user();
        $negociacion = Negociacion::findOrFail($idNegociacion);

        // Verificar si el usuario actual es parte de la negociación
        if ($userId !== $negociacion->id_cliente && $userId !== $negociacion->id_trabajadores) {
            abort(403, 'No tienes permiso para acceder a esta negociación.');
        }

        $mensajes = $negociacion->mensajes()->with('users')->orderBy('created_at', 'asc')->get();

        // Redirigir a la vista correspondiente según el rol
        if ($user->id_roles == 3) { // Cliente
            return view('cliente.solicitudes.negociacion', compact('mensajes', 'idNegociacion'));
        } elseif ($user->id_roles == 2) { // Trabajador
            return view('trabajador.trabajos.negociacion', compact('mensajes', 'idNegociacion'));
        }

        abort(403, 'No tienes permiso para acceder a esta negociación.');
    }

    // Guardar un nuevo mensaje
    public function store(Request $request)
{
    $userId = Auth::id(); // ID del usuario autenticado
    $user = Auth::user();
    $negociacion = Negociacion::findOrFail($request->id_negociacion); // Buscar la negociación

    // Verificar si el usuario actual está relacionado con la negociación
    $cliente = $user->cliente;
    $trabajador = $user->trabajadores;

    $esCliente = $cliente && $cliente->id_cliente === $negociacion->id_cliente;
    $esTrabajador = $trabajador && $trabajador->id_trabajadores === $negociacion->id_trabajadores;

    if (!$esCliente && !$esTrabajador) {
        abort(403, 'No tienes permiso para enviar mensajes en esta negociación.');
    }

    // Validar el contenido del mensaje
    $request->validate([
        'id_negociacion' => 'required|exists:negociacion,id_negociacion',
        'contenido' => 'required|string',
        'tipo' => 'in:texto,archivo',
        'archivo_url' => 'nullable|string',
    ]);

    // Crear el mensaje
    Mensaje::create([
        'id_negociacion' => $request->id_negociacion,
        'id_usuario' => $userId,
        'contenido' => $request->contenido,
        'tipo' => $request->tipo ?? 'texto',
        'archivo_url' => $request->archivo_url,
    ]);

    // Redirigir a la vista de negociación
    if ($esCliente) {
        return redirect()->route('cliente.negociacion.ver', $request->id_negociacion)
            ->with('success', 'Mensaje enviado con éxito.');
    }

    if ($esTrabajador) {
        return redirect()->route('trabajador.negociacion.ver', $request->id_negociacion)
            ->with('success', 'Mensaje enviado con éxito.');
    }

    // Si no es cliente ni trabajador (esto no debería suceder)
    abort(403, 'No tienes permiso para enviar mensajes en esta negociación.');
}


}
