<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    // Mostrar el formulario de registro de cliente
    public function formulario()
    {
        return view('cliente.formulario');
    }

    // Guardar el perfil de cliente
    public function guardarFormulario(Request $request)
    {
        $request->validate([
            'nom_cliente' => 'required|string|max:100',
            'ape_cliente' => 'required|string|max:100',
            'telefo_cliente' => 'nullable|string|max:9',
            'dni' => 'required|string|max:8|unique:clientes',
            'sexo' => 'required|in:M,F',
            'ciudad' => 'required|string|max:255',
            'distrito' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
        ]);

            // Crear la ubicación
        $ubicacion = Ubicacion::create([
            'ciudad' => $request->ciudad,
            'distrito' => $request->distrito,
            'direccion' => $request->direccion,
        ]);

        Cliente::create([
            'id_usuario' => Auth::id(),
            'id_ubicacion' => $ubicacion->id_ubicacion,    // Ajustar según la lógica de ubicación
            'nom_cliente' => $request->nom_cliente,
            'ape_cliente' => $request->ape_cliente,
            'telefo_cliente' => $request->telefo_cliente,
            'dni' => $request->dni,
            'sexo' => $request->sexo,
        ]);

        return redirect()->route('cliente.dashboard')->with('success', 'Registro completado.');
    }
}
