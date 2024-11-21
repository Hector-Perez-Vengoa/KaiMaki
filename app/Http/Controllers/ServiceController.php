<?php

namespace App\Http\Controllers;

use App\Models\Trabajadores;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function servicios(Request $request)
    {
        $search = $request->get('search');

        // Buscar trabajadores que tengan un oficio que coincida con el término de búsqueda
        if ($search) {
            $trabajadores = Trabajadores::whereHas('oficios', function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%'); // Cambia 'nombre' si el nombre del oficio es diferente
            })->with('oficios')->get();
        } else {
            $trabajadores = Trabajadores::with('oficios')->get(); // Traer todos los trabajadores con sus oficios
        }
       
        return view('servicios.servicios')->with('trabajadores', $trabajadores);
    }
    
}
