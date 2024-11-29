<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class RedirectToDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        if (Auth::check()) {
            $user = Auth::user();

            // Redirigir según el rol
            if ($user->id_roles == 1) { // Administrador
                return redirect()->route('admin.dashboard');
            } elseif ($user->id_roles == 2) { // Trabajador
                return redirect()->route('trabajador.dashboard');
            } elseif ($user->id_roles == 3) { // Cliente
                return redirect()->route('cliente.dashboard');
            }


        return $next($request);
        }
    }
}
