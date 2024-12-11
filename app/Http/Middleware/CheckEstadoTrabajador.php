<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckEstadoTrabajador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    $user = Auth::user();

    // Verificar que el usuario sea un trabajador y que su estado no sea activo
    if ($user && $user->id_roles == 2 && $user->estado->nombre_estado !== 'Activo') {
        return redirect()->route('trabajador.bloqueado')->with('error', 'Tu perfil aún no está activado por el administrador.');
    }

    return $next($request);
}

}
