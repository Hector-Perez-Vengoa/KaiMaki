<?php

namespace App\Http\Controllers;

use App\Models\Negociacion;
use App\Notifications\CambiosNegociacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NegociacionController extends Controller
{
    public function show($idNegociacion)
    {
        $negociacion = Negociacion::findOrFail($idNegociacion);

        $userId = Auth::id();
        $cliente = Auth::user()->cliente;
        $trabajador = Auth::user()->trabajadores;

        // Verificar si el usuario autenticado es cliente o trabajador relacionado
        $esCliente = $cliente && $cliente->id_cliente === $negociacion->id_cliente;
        $esTrabajador = $trabajador && $trabajador->id_trabajadores === $negociacion->id_trabajadores;

        if (!$esCliente && !$esTrabajador) {
            abort(403, 'No tienes permiso para acceder a esta negociación.');
        }

        // Cargar los mensajes de la negociación
        $mensajes = $negociacion->mensajes()->with('users')->orderBy('created_at', 'asc')->get();

        // Determinar la vista según el rol del usuario
        if ($esTrabajador) {
            return view('trabajador.trabajos.negociacion', compact('negociacion', 'mensajes'));
        } elseif ($esCliente) {
            return view('cliente.solicitudes.negociacion', compact('negociacion', 'mensajes'));
        }

        abort(403, 'No tienes permiso para acceder a esta negociación.');
    }

    public function update(Request $request, $idNegociacion)
{
    $negociacion = Negociacion::findOrFail($idNegociacion);

    $cliente = Auth::user()->cliente;
    $trabajador = Auth::user()->trabajadores;

    // Verificar si el usuario autenticado es cliente o trabajador relacionado
    $esCliente = $cliente && $cliente->id_cliente === $negociacion->id_cliente;
    $esTrabajador = $trabajador && $trabajador->id_trabajadores === $negociacion->id_trabajadores;

    if (!$esCliente && !$esTrabajador) {
        abort(403, 'No tienes permiso para realizar cambios en esta negociación.');
    }

    // Validar los datos enviados
    $request->validate([
        'nueva_fecha_reserva' => 'nullable|date|after_or_equal:today',
        'hora_inicio' => 'nullable|date_format:H:i',
        'monto' => 'nullable|numeric|min:0',
        'ubicacion_nueva' => 'nullable|string|max:255',
    ]);

    // Guardar los cambios propuestos
    $negociacion->update([
        'nueva_fech_reserva' => $request->nueva_fecha_reserva,
        'hora_inicio' => $request->hora_inicio,
        'monto' => $request->monto,
        'ubicacion_nueva' => $request->ubicacion_nueva,
        'estado_negociacion' => 'En proceso', // Propuesta en curso
    ]);

    // Notificar a la otra parte
    if ($esCliente) {
        $trabajadorUsuario = $negociacion->trabajador->users ?? null;
        if ($trabajadorUsuario) {
            $trabajadorUsuario->notify(new CambiosNegociacion($negociacion, 'propuesta'));
        }
    } elseif ($esTrabajador) {
        $clienteUsuario = $negociacion->cliente->users ?? null;
        if ($clienteUsuario) {
            $clienteUsuario->notify(new CambiosNegociacion($negociacion, 'propuesta'));
        }
    }

    return redirect()->back()->with('success', 'Cambios propuestos correctamente. La otra parte debe aceptarlos.');
}




public function responderCambios(Request $request, $idNegociacion)
{
    $negociacion = Negociacion::findOrFail($idNegociacion);

    // Validar la acción
    $request->validate([
        'respuesta' => 'required|in:aceptar,rechazar',
        'notification_id' => 'required', // Para eliminar la notificación después
    ]);

    if ($request->respuesta === 'aceptar') {
        // Aceptar cambios: aplicar los valores propuestos
        $negociacion->update([
            'fecha_reserva' => $negociacion->nueva_fech_reserva,
            'hora_inicio' => $negociacion->hora_inicio,
            'ubicacion' => $negociacion->ubicacion_nueva,
            'monto' => $negociacion->monto,
            'estado_negociacion' => 'Aceptada', // Cambia el estado
        ]);
    } elseif ($request->respuesta === 'rechazar') {
        // Rechazar cambios: descartar los valores propuestos
        $negociacion->update([
            'estado_negociacion' => 'Rechazada', // Cambia el estado
        ]);
    }

    // Eliminar la notificación
    $notification = Auth::user()->notifications()->find($request->notification_id);
    if ($notification) {
        $notification->delete();
    }

    $message = $request->respuesta === 'aceptar' ? 'Cambios aceptados correctamente.' : 'Cambios rechazados.';
    return redirect()->back()->with('success', $message);
}

}
