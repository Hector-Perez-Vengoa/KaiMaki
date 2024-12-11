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

        // Define roles y rutas de redirección
        $rolesConValidacion = [
            3 => ['relation' => 'clientes', 'redirect' => 'cliente.formulario', 'store' => 'cliente.store'],
            2 => ['relation' => 'trabajadores', 'redirect' => 'trabajador.formulario', 'store' => 'trabajadores.store'],
            1 => ['relation' => 'administrador', 'redirect' => 'administrador.formulario', 'store' => 'administrador.store'],
        ];

        if (array_key_exists($user->id_roles, $rolesConValidacion)) {
            $relation = $rolesConValidacion[$user->id_roles]['relation'];
            $redirectRoute = $rolesConValidacion[$user->id_roles]['redirect'];
            $storeRoute = $rolesConValidacion[$user->id_roles]['store'];

            // Verifica si la relación está vacía o el campo requerido no está presente
            if (!$user->$relation || !$user->$relation->dni) {
                // Evita redirección cíclica en las rutas del formulario
                if (!$request->routeIs($redirectRoute, $storeRoute)) {
                    return redirect()->route($redirectRoute)
                        ->with('error', 'Por favor, completa tu perfil antes de continuar.');
                }
            }
        }

        return $next($request); // Permitir el acceso si cumple las condiciones
    }
}
