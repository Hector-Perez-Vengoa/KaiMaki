<?php

namespace App\Http\Controllers;

use App\Models\Problema;
use App\Models\Oficios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProblemaController extends Controller
{
    // Crear un problema
    // Mostrar el formulario para publicar un problema
    public function create()
    {
        // Verificar si el modelo Oficios está correctamente configurado
        $oficios = Oficios::all();
    
        // Depurar los datos de $oficios
        if ($oficios->isEmpty()) {
            // Si no hay datos, redirige con un error
            return redirect()->route('cliente.dashboard')->withErrors('No hay oficios disponibles. Por favor, agrega oficios primero.');
        }
    
        // Pasar los oficios a la vista
        return view('cliente.problemas.create', compact('oficios'));
    }
    

    // Guardar un problema publicado por el cliente
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_oficios' => 'required|exists:oficios,id_oficios',
            'descripcion' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'monto' => 'nullable|numeric|min:0',
            'urgente' => 'nullable|boolean', // Validar el campo "urgente"
        ]);
    
        // Manejar la imagen (opcional)
        $path = null;
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('problemas', 'public');
        }
    
        // Determinar el estado (Urgente o Pendiente)
        $estadoProblemaId = $request->boolean('urgente')
            ? 5 // ID del estado "Urgente"
            : 1; // ID del estado "Pendiente"
    
        // Crear el problema
        Problema::create([
            'id_cliente' => Auth::user()->cliente->id_cliente,
            'id_oficios' => $validated['id_oficios'],
            'descripcion' => $validated['descripcion'],
            'imagen' => $path,
            'monto' => $validated['monto'],
            'fecha' => now(),
            'id_estado_problema' => $estadoProblemaId,
        ]);
    
        return redirect()->route('cliente.problemas.index')->with('success', 'Problema publicado exitosamente.');
    }
    
    

    // Listar problemas del cliente
    public function index()
    {
        // Obtener el cliente autenticado
        $clienteId = Auth::user()->cliente->id_cliente;
    
        // Obtener los problemas relacionados con el cliente
        $problemas = Problema::where('id_cliente', $clienteId)
        ->with('oficio', 'estadoProblema')
        ->orderByRaw("CASE WHEN id_estado_problema = 5 THEN 0 ELSE 1 END") // Coloca urgentes primero
        ->orderBy('created_at', 'desc') // Ordena por fecha después
        ->get();
    
        // Obtener todos los oficios para el modal
        $oficios = Oficios::all();
    
        // Pasar las variables a la vista
        return view('cliente.problemas.index', compact('problemas', 'oficios'));
    }
    
    
    

    // Mostrar detalles de un problema
    public function show($id)
    {
        $problema = Problema::with('cliente', 'oficio', 'estadoProblema')->findOrFail($id);

        return view('cliente.problemas.show', compact('problema'));
    }

    // Editar un problema
    public function edit($id)
    {
        $problema = Problema::findOrFail($id);
        $oficios = Oficios::all();

        return view('cliente.problemas.edit', compact('problema', 'oficios'));
    }

    // Actualizar un problema
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_oficios' => 'required|exists:oficios,id_oficios',
            'descripcion' => 'required|string|max:255',
            'monto' => 'nullable|numeric',
        ]);

        $problema = Problema::findOrFail($id);

        // Manejar la actualización de imagen (opcional)
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('problemas', 'public');
            $problema->imagen = $path;
        }

        $problema->update([
            'id_oficios' => $validated['id_oficios'],
            'descripcion' => $validated['descripcion'],
            'monto' => $validated['monto'],
        ]);

        return redirect()->route('cliente.dashboard')->with('success', 'Problema actualizado correctamente.');
    }

    // Marcar problema como urgente
    public function marcarUrgente($id)
    {
        // Busca el problema
        $problema = Problema::findOrFail($id);
    
        // Obtiene el ID del estado "Urgente"
        $estadoUrgente = \DB::table('estado_problema')
            ->where('nombre_estado', 'Urgente')
            ->value('id_estado_problema');
    
        // Actualiza el estado del problema
        $problema->update(['id_estado_problema' => $estadoUrgente]);
    
        return redirect()->route('cliente.problemas.index')->with('success', 'El problema ha sido marcado como urgente.');
    }

    public function destroy($id)
    {
        // Buscar el problema
        $problema = Problema::findOrFail($id);

        // Verificar si el cliente autenticado es el dueño del problema
        if (Auth::user()->cliente->id_cliente !== $problema->id_cliente) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        // Eliminar el problema
        $problema->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('cliente.problemas.index')->with('success', 'El problema fue eliminado correctamente.');
    }

        
}
