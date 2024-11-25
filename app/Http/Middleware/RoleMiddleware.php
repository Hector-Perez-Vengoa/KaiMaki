<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Verifica que el usuario esté autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        // Compara el rol del usuario autenticado con el rol requerido
        $userRole = Auth::user()->id_roles;

        if ($userRole != $role) {
            return redirect('/');
        }

        // Continua con la solicitud si el rol coincide
        return $next($request);
    }
}

