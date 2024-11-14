<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    public function formulario()
    {
        // Aquí puedes devolver una vista o lógica adicional
        return view('trabajador.formulario'); // Suponiendo que tienes una vista llamada cliente.dashboard
    }

    public function tareas()
    {
        return view('trabajador.tareas'); // Crear la vista
    }

    public function reportes()
    {
        return view('trabajador.reportes'); // Crear la vista
    }

    public function solicitudes()
    {
        return view('trabajador.solicitudes'); // Crear la vista
    }
}
