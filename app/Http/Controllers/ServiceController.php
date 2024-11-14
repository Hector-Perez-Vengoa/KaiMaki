<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function servicios(Request $request)
    {
        $search = $request->get('search');

        // Si hay un término de búsqueda, filtra los trabajadores por oficio
        if ($search) {
            $trabajadores = Trabajador::where('oficio_tmp', 'like', '%' . $search . '%')->get();
        } else {
            $trabajadores = Trabajador::all();  // Si no hay búsqueda, mostrar todos los trabajadores
        }

        return view('servicios.servicios')->with('trabajadores', $trabajadores);
    }
    
}
