<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function formulario()
    {
        // Aquí puedes devolver una vista o lógica adicional
        return view('cliente.formulario'); // Suponiendo que tienes una vista llamada 
    }
    public function datos()
    {
        return view('cliente.datos'); // Crear la vista
    }

    public function perfil()
    {
        return view('cliente.perfil'); // Crear la vista
    }

    public function solicitudes()
    {
        return view('cliente.solicitudes'); // Crear la vista
    }
}
