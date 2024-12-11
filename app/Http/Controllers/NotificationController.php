<?php

namespace App\Http\Controllers;

use App\Models\Negociacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Marcar todas las notificaciones como leídas
    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'Todas las notificaciones fueron marcadas como leídas.');
    }

    // Marcar una notificación específica como leída
    public function markAsRead($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($id);
        $notification->markAsRead();
        return redirect()->back()->with('success', 'Notificación marcada como leída.');
    }
    // Responder a una notificación (aceptar/rechazar cambios)
    public function respond(Request $request, $idNegociacion)
{

    $negociacion = Negociacion::findOrFail($idNegociacion);
    $user = Auth::user();

    // Validar la respuesta
    $request->validate([
        'respuesta' => 'required|in:aceptar,rechazar',
        'notification_id' => 'required',
    ]);

    $respuesta = $request->input('respuesta');

    if ($respuesta === 'aceptar') {
        // Aplicar los cambios propuestos
        $negociacion->update([
            'estado_negociacion' => 'Aceptada',
            'nueva_fech_reserva' => $negociacion->nueva_fech_reserva,
            'hora_inicio' => $negociacion->hora_inicio,
            'ubicacion_nueva' => $negociacion->ubicacion_nueva,
            'monto' => $negociacion->monto,
        ]);
    }

    if ($respuesta === 'rechazar') {
        // Rechazar cambios: limpiar valores temporales
        $negociacion->update([
            'estado_negociacion' => 'Rechazada',
            'nueva_fecha_reserva' => null,
            'hora_inicio' => null,
            'ubicacion_nueva' => null,
            'monto' => 0, // Usa el valor actual de monto o 0
        ]);
    }

    // Eliminar la notificación
    $notification = $user->notifications()->find($request->input('notification_id'));
    if ($notification) {
        $notification->delete();
    }

    $message = $respuesta === 'aceptar' ? 'Cambios aceptados correctamente.' : 'Cambios rechazados.';
    return redirect()->back()->with('success', $message);
}






}
