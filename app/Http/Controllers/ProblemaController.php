<?php

namespace App\Http\Controllers;

use App\Models\Problema;
use App\Models\Oficios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProblemaController extends Controller
{
    public function create()
    {
        // Obtén los datos de los oficios
        $oficios = Oficios::all();

    
        // Si no hay oficios, muestra un error al usuario
        if ($oficios->isEmpty()) {
            return redirect()->back()->withErrors('No hay oficios disponibles. Por favor, agrega oficios primero.');
        }
    
        // Devuelve la vista del formulario con los oficios disponibles
        return view('cliente.problemas.create', compact('oficios'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'id_oficios' => 'required|exists:oficios,id_oficios',
            'descripcion' => 'required|string|max:255',
            'monto' => 'nullable|numeric',
        ]);

        // Crear un nuevo problema
        Problema::create([
            'id_cliente' => Auth::user()->cliente->id_cliente,
            'id_oficios' => $validated['id_oficios'],
            'descripcion' => $validated['descripcion'],
            'monto' => $validated['monto'],
            'fecha' => now(),
            'id_estado_problema' => 1, // Estado inicial
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('cliente.dashboard')->with('success', 'Problema publicado exitosamente.');
    }

        /**
     * Listar los problemas de un cliente.
     */
    public function index()
    {
        // Obtener el cliente autenticado
        $clienteId = Auth::user()->cliente->id_cliente;

        // Obtener los problemas relacionados con el cliente
        $problemas = Problema::where('id_cliente', $clienteId)->with('oficio', 'estadoProblema')->get();

        // Retornar la vista con los problemas
        return view('cliente.problemas.index', compact('problemas'));
    }

    public function show($id)
    {
        $problema = Problema::with('cliente', 'oficio', 'estadoProblema')->findOrFail($id);

        return view('cliente.problemas.show', compact('problema'));
    }

    
    public function edit($id)
    {
        $problema = Problema::findOrFail($id);
        $oficios = Oficios::all(); // Si deseas permitir cambiar el oficio

        return view('cliente.problemas.edit', compact('problema', 'oficios'));
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_oficios' => 'required|exists:oficios,id_oficios',
            'descripcion' => 'required|string|max:255',
            'monto' => 'nullable|numeric',
        ]);

        $problema = Problema::findOrFail($id);
        $problema->update([
            'id_oficios' => $validated['id_oficios'],
            'descripcion' => $validated['descripcion'],
            'monto' => $validated['monto'],
        ]);

        return redirect()->route('cliente.dashboard')->with('success', 'Problema actualizado correctamente.');
    }

    

}
