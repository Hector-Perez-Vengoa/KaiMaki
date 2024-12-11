<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Negociacion;
use App\Models\Reclamos;
use App\Models\Ubicacion;
use App\Models\Trabajadores;
use App\Models\Solicitud;
use App\Models\TrabajoCampo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    // Mostrar el formulario de registro de cliente
    public function formulario()
    {
        // Verificar si el usuario ya ha completado su registro
        $userId = Auth::id();
        $cliente = Cliente::where('id_usuario', $userId)->first();

        if ($cliente) {
            // Si el cliente ya está registrado, redirigir al dashboard con un mensaje
            return redirect()->route('cliente.dashboard')->with('info', 'Ya has registrado tus datos. No es necesario que completes este formulario nuevamente.');
        }

        // Si no está registrado, mostrar el formulario
        return view('cliente.formulario');
    }

    // Guardar el perfil de cliente
    public function guardarFormulario(Request $request)
    {
        // Validar los datos del formulario
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

        // Crear el registro del cliente
        Cliente::create([
            'id_usuario' => Auth::id(),
            'id_ubicacion' => $ubicacion->id_ubicacion, // Ajustar según la lógica de ubicación
            'nom_cliente' => $request->nom_cliente,
            'ape_cliente' => $request->ape_cliente,
            'telefo_cliente' => $request->telefo_cliente,
            'dni' => $request->dni,
            'sexo' => $request->sexo,
        ]);

        // Redirigir al dashboard con un mensaje de éxito
        return redirect()->route('cliente.dashboard')->with('success', 'Registro completado.');
    }

    public function solicitudes(Request $request)
    {
        // Obtener el usuario autenticado
        $usuario = Auth::user();

        // Obtener el ID del trabajador asociado al usuario autenticado
        $cliente = $usuario->clientes()->first();
        $idTrabajador = $cliente->id_cliente;

        // Obtener el estado a filtrar desde la solicitud
        $estado = $request->input('estado');

        // Iniciar la consulta base
        $query = Solicitud::where('id_cliente', $idTrabajador)
            ->with(['cliente', 'estado', 'negociaciones' => function ($query) {
                $query->latest('created_at'); // Ordenar por la última negociación
            }]);

        // Aplicar la condición para filtrar solicitudes
        if ($estado == 5) {
            // Si el estado es 5, buscar solicitudes con estado 5 o 6
            $query->whereIn('id_estado_solicitudes', [5, 6]);
        } else {
            // Filtrar por el estado específico
            $query->where('id_estado_solicitudes', $estado);
        }

        // Obtener las solicitudes filtradas
        $solicitudes = $query->get();

        // Pasar las solicitudes a la vista
        return view('cliente.solicitudes', compact('solicitudes'));
    }

    public function renegociar(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'id_solicitudes' => 'required',
            'monto' => 'required|min:0',
            'nueva_fech_reserva' => 'required|date',
            'hora_inicio' => 'required',
            'tiempo_estimado' => 'required',
            'mensaje' => 'nullable',
        ]);

        // Crear una nueva negociación
        Negociacion::create([
            'id_solicitudes' => $validatedData['id_solicitudes'],
            'monto' => $validatedData['monto'],
            'nueva_fech_reserva' => $validatedData['nueva_fech_reserva'],
            'hora_inicio' => $validatedData['hora_inicio'],
            'tiempo_estimado' => $validatedData['tiempo_estimado'],
            'mensaje' => $validatedData['mensaje'] ?? null,
        ]);

        // Realizar la actualización de estado
        Solicitud::where('id_solicitudes', $validatedData['id_solicitudes'])
            ->update(['id_estado_solicitudes' => 6]);

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'La negociación se ha registrado correctamente.');
    }

    public function actualizarEstado(Request $request)
    {
        // Validar que el estado es válido
        $validated = $request->validate([
            'id_solicitudes' => 'required|exists:solicitudes,id_solicitudes',
            'estado' => 'required|integer',
        ]);

        // Obtener la solicitud con sus negociaciones
        $solicitud = Solicitud::with(['negociaciones' => function ($query) {
            $query->latest('created_at'); // Ordenar por la última negociación
        }])->findOrFail($validated['id_solicitudes']);

        // Si el estado es igual a 2, crear una instancia en la tabla TrabajoCampo
        if ($validated['estado'] == 2) {
            // Obtener la última negociación
            $ultimaNegociacion = $solicitud->negociaciones->first();

            // Verificar si ya existe un registro para evitar duplicados
            $trabajoExistente = TrabajoCampo::where('id_solicitudes', $validated['id_solicitudes'])->first();

            if (!$trabajoExistente && $ultimaNegociacion) {
                TrabajoCampo::create([
                    'id_solicitudes' => $validated['id_solicitudes'],
                    'hora_entrada' => $ultimaNegociacion->hora_entrada,
                    'hora_salida' => null,
                    'oficio_serv' => null,
                    'monto' => $ultimaNegociacion->monto,
                    'puntuacion' => null,
                ]);
            }
        }

        // Actualizar el estado
        $solicitud->update(['id_estado_solicitudes' => $validated['estado']]);

        return redirect()->back()->with('success', 'El estado de la solicitud se ha actualizado correctamente.');
    }



    public function puntuacion(Request $request)
    {
        $validated = $request->validate([
            'id_solicitudes' => 'required',
            'puntuacion' => 'required',
        ]);
        // Puntuacion en la tabla
        // Buscar el registro asociado a la solicitud
        $trabajoCampo = TrabajoCampo::where('id_solicitudes', $validated['id_solicitudes'])->first();

        if (!$trabajoCampo) {
            return redirect()->back()->withErrors(['error' => 'El registro de trabajo no existe.']);
        }

        // Actualizar la puntuación
        $trabajoCampo->puntuacion = $validated['puntuacion'];
        $trabajoCampo->save();

        //Actualizar la puntuacion del trabajador

        // Obtener la solicitud asociada
        $solicitud = Solicitud::findOrFail($validated['id_solicitudes']);

        // Verificar si la solicitud tiene un trabajador asociado
        if ($solicitud->trabajador) {
            // Obtener los trabajos en campo relacionados al trabajador
            // Calcular el promedio de puntuaciones de los trabajos
            $promedio = $trabajoCampo->avg('puntuacion');

            if ($promedio !== null) {
                // Redondear el promedio a 2 decimales
                $promedioRedondeado = round($promedio, 2);

                // Actualizar el valor de la puntuación en el trabajador
                Trabajadores::where('id_trabajadores', $solicitud->id_trabajadores)->update(['puntuacion' => $promedioRedondeado]);
            }
        }

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', '¡Calificación enviada con éxito!');


    }
    public function verSolicitudes()
    {
        // Obtener el cliente autenticado
        $cliente = Auth::user()->cliente;

        if (!$cliente) {
            return redirect()->back()->with('error', 'No tienes un perfil de cliente.');
        }

        // Obtener todas las solicitudes relacionadas con este cliente
        $solicitudes = Solicitud::where('id_cliente', $cliente->id_cliente)
            ->with(['negociaciones', 'trabajador', 'estado', 'problemas.oficio']) // Relaciones necesarias
            ->get();

        // Extraer todas las negociaciones relacionadas con el cliente
        $negociaciones = Negociacion::where('id_cliente', $cliente->id_cliente)
            ->with(['solicitud', 'mensajes', 'trabajador']) // Relaciones necesarias
            ->get();

        // Pasar tanto las solicitudes como las negociaciones a la vista
        return view('cliente.solicitudes.solicitudes', compact('solicitudes', 'negociaciones'));
    }

}
