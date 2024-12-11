<?php

namespace App\Http\Controllers;

use App\Models\Problema;
use App\Models\Oficios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ProblemaController extends Controller
{
       // Mostrar el formulario para publicar un problema
       public function create()
       {
           // Cargar los oficios disponibles para el dropdown
           $oficios = Oficios::all(); // Suponiendo que tienes un modelo 'Oficio'

           // Obtener la ubicación registrada del cliente autenticado
           $cliente = Auth::user()->cliente; // Relación entre usuario y cliente
           $ubicacion = $cliente->ubicacion ?? null;

           return view('cliente.problemas.create', compact('oficios', 'ubicacion'));
       }

       public function store(Request $request)
       {
           // Validar los datos
           $validated = $request->validate([
               'id_oficios' => 'required|exists:oficios,id_oficios',
               'descripcion' => 'required|string|max:255',
               'monto' => 'nullable|numeric|min:0',
               'fecha_reserva' => 'required|date|after:today',
               'ubicacion_tipo' => 'required|string|in:registrada,alternativa',
               'direccion_alternativa' => 'nullable|required_if:ubicacion_tipo,alternativa|string|max:255',
               'distrito_alternativa' => 'nullable|required_if:ubicacion_tipo,alternativa|string|max:100',
               'ciudad_alternativa' => 'nullable|required_if:ubicacion_tipo,alternativa|string|max:100',
               'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
               'urgente' => 'nullable|boolean',
           ]);

           // Construir la ubicación alternativa (si aplica)
           $ubicacionAlternativa = null;
           if ($request->ubicacion_tipo === 'alternativa') {
               $ubicacionAlternativa = implode(', ', [
                   $request->direccion_alternativa,
                   $request->distrito_alternativa,
                   $request->ciudad_alternativa,
               ]);
           }

           // Guardar la imagen (si se sube)
           $path = $request->hasFile('imagen')
               ? $request->file('imagen')->store('problemas', 'public')
               : null;

           // Crear el problema
           Problema::create([
               'id_cliente' => Auth::user()->cliente->id_cliente,
               'id_oficios' => $validated['id_oficios'],
               'descripcion' => $validated['descripcion'],
               'monto' => $validated['monto'],
               'fecha_reserva' => $validated['fecha_reserva'],
               'ubicacion_alternativa' => $ubicacionAlternativa,
               'imagen' => $path,
               'urgente' => $request->boolean('urgente'),
               'fecha' => now(),
               'id_estado_problema' => $request->boolean('urgente') ? 5 : 1,
           ]);

           return redirect()->route('problemas.index')->with('success', 'Problema creado exitosamente.');
       }


       public function index(Request $request)
       {
           $cliente = Auth::user()->cliente; // Relación cliente-usuario

           // Construcción de la consulta base
           $query = Problema::with(['oficio', 'estadoProblema', 'cliente.ubicacion'])
               ->where('id_cliente', $cliente->id_cliente);

           // Filtrar por estado si se proporciona en la solicitud
           if ($request->has('estado')) {
               $query->where('id_estado_problema', $request->estado);
           }

           // Ordenar problemas: urgentes primero, luego por fecha de creación
           $problemas = $query->orderByRaw("FIELD(id_estado_problema, 5, 1) ASC")
               ->orderBy('created_at', 'asc') // Más antiguos primero
               ->distinct() // Eliminar duplicados
               ->get();

           return view('cliente.problemas.index', compact('problemas'));
       }






       public function edit($id)
       {
           // Buscar el problema
           $problema = Problema::findOrFail($id);

           // Cargar los oficios
           $oficios = Oficios::all();

           // Obtener la ubicación registrada del cliente
           $cliente = Auth::user()->cliente;
           $ubicacion = $cliente->ubicacion ?? null;

           return view('cliente.problemas.edit', compact('problema', 'oficios', 'ubicacion'));
       }


       public function destroy($id)
       {
           // Buscar el problema
           $problema = Problema::findOrFail($id);

           // Eliminar el problema
           $problema->delete();

           // Redirigir al índice con un mensaje de éxito
           return redirect()->route('problemas.index')->with('success', 'Problema eliminado correctamente.');
       }

       public function update(Request $request, $id)
       {
           $validated = $request->validate([
               'id_oficios' => 'required|exists:oficios,id_oficios',
               'descripcion' => 'required|string|max:255',
               'monto' => 'nullable|numeric|min:0',
               'fecha_reserva' => 'nullable|date|after:today',
               'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
               'id_estado_problema' => 'required|in:1,5', // Solo permitir Pendiente (1) y Urgente (5)
           ]);

           $problema = Problema::findOrFail($id);

           // Actualizar la imagen si es necesario
           if ($request->hasFile('imagen')) {
               $path = $request->file('imagen')->store('problemas', 'public');
               $problema->imagen = $path;
           }

           $problema->update([
               'id_oficios' => $validated['id_oficios'],
               'descripcion' => $validated['descripcion'],
               'monto' => $validated['monto'],
               'fecha_reserva' => $validated['fecha_reserva'],
               'id_estado_problema' => $validated['id_estado_problema'], // Actualizar el estado
           ]);

           return redirect()->route('problemas.index')->with('success', 'Problema actualizado correctamente.');
       }





   }
