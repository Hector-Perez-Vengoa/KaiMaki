<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    public function dashboard()
    {
        // Aquí puedes devolver una vista o lógica adicional
        return view('trabajador.index'); // Suponiendo que tienes una vista llamada cliente.dashboard
    }
}
