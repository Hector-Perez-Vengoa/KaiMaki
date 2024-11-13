<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, $role)
    {
        // Verificar que el usuario esté autenticado
        if (!Auth::check()) {
            return redirect('login');
        }

        // Verificar que el usuario tenga el rol especificado
        if (Auth::user()->id_roles != $role) {
            abort(403, 'No tienes acceso a esta página.');
        }

        return $next($request);
    }
}
