<?php
// app/Actions/Fortify/LoginResponse.php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();
        // Redirección condicional según rol
        if ($user->rol_id == 1) {
            return redirect()->route('cliente.index');
        } elseif ($user->rol_id == 2) {
            return redirect()->route('trabajador.index');
        }
        
        // Redirección por defecto
        return redirect()->route('dashboard');
    }
}
