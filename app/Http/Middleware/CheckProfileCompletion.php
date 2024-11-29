<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

    // Redirigir clientes sin perfil completo al formulario
    if ($user->id_roles === 3 &&  (!$user->clientes || !$user->clientes->dni)) {
        // Asegúrate de que no redirija en la misma ruta del formulario
        if (!$request->routeIs('cliente.formulario', 'cliente.store')) {
            return redirect()->route('cliente.formulario')
                ->with('error', 'Por favor, completa tu perfil antes de continuar.');
        }
    }

    // Redirigir trabajadores sin perfil completo al formulario
    if ($user->id_roles === 2 && (!$user->trabajadores || !$user->trabajadores->dni)) {
        // Asegúrate de que no redirija en la misma ruta del formulario
        if (!$request->routeIs('trabajador.formulario', 'trabajadores.store')) {
            return redirect()->route('trabajador.formulario')
                ->with('error', 'Por favor, completa tu perfil antes de continuar.');
        }
    }

    return $next($request); // Permitir el acceso si cumple las condiciones

    }
}
