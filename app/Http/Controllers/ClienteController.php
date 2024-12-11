<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Negociacion;
use App\Models\Reclamos;
use App\Models\Ubicacion;
use App\Models\Solicitud;
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

    public function solicitudes()
    {
        $clienteId = Auth::user()->cliente->id_cliente;

        // Obtener las solicitudes del cliente autenticado
        $solicitudes = Solicitud::where('id_cliente', $clienteId)
            ->with(['trabajador', 'estado', 'negociaciones' => function ($query) {
                $query->latest('created_at'); // Ordenar por la última negociación
            }])
            ->get();

        // Pasar las solicitudes a la vista
        return view('cliente.solicitudes', compact('solicitudes'));
    }

    public function regociaciar(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'id_solicitudes' => 'required',
            'monto' => 'required|min:0',
            'nueva_fech_reserva' => 'required|date',
            'hora_inicio' => 'required',
            'tiempo_estimado' => 'required',
        ]);

        // Crear una nueva negociación
        Negociacion::create([
            'id_solicitudes' => $validatedData['id_solicitudes'],
            'monto' => $validatedData['monto'],
            'nueva_fech_reserva' => $validatedData['nueva_fech_reserva'],
            'hora_inicio' => $validatedData['hora_inicio'],
            'tiempo_estimado' => $validatedData['tiempo_estimado'],
        ]);

        // Realizar la actualización de estado
        Solicitud::where('id_solicitudes', $validatedData['id_solicitudes'])
            ->update(['id_estado_solicitudes' => 6]);

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'La negociación se ha registrado correctamente.');
    }

    public function cambiarEstado(Solicitud $solicitud, $estado)
    {
        // Actualizar el estado de la solicitud
        $solicitud->update(['id_estado_solicitudes' => $estado]);

        return redirect()->back()->with('success', 'El estado de la solicitud ha sido actualizado.');
    }


    //Acepta la solicitud

    public function aceptarSolicitud($idSolicitud)
    {
        // Obtener la solicitud
        $solicitud = Solicitud::findOrFail($idSolicitud);

        // Verificar si la solicitud pertenece al cliente autenticado
        $cliente = Auth::user()->cliente;
        if ($solicitud->id_cliente !== $cliente->id_cliente) {
            return redirect()->back()->with('error', 'No tienes permiso para aceptar esta solicitud.');
        }

        // Cambiar el estado de la solicitud a "Aceptada"
        $solicitud->update(['id_estado_solicitudes' => 2]); // Estado 2: Aceptada

        // Crear un nuevo registro en la tabla de negociaciones
        $negociacion = Negociacion::create([
            'id_solicitudes' => $solicitud->id_solicitudes,
            'id_cliente'=> $solicitud->id_cliente,
            'id_trabajadores'=> $solicitud->id_trabajadores,
            'monto' => 0, // Monto inicial (puede ser ajustado en la negociación)
            'nueva_fech_reserva' => $solicitud->fech_reserva,
            'hora_inicio' => $solicitud->hora_inicio_propuesta,
            'tiempo_estimado' => '01:00:00', // Tiempo estimado inicial
            'mensaje' => 'Negociación iniciada. Por favor, comience la conversación.',
        ]);

        // Redirigir a la vista de negociación
        return redirect()->route('cliente.solicitudes', $negociacion->id_negociacion)
        ->with('success', 'Solicitud aceptada y negociación iniciada.');
    }

    public function rechazarSolicitud($idSolicitud)
    {
        // Obtener la solicitud
        $solicitud = Solicitud::findOrFail($idSolicitud);

        // Verificar si la solicitud pertenece al cliente autenticado
        $cliente = Auth::user()->cliente;
        if ($solicitud->id_cliente !== $cliente->id_cliente) {
            return redirect()->back()->with('error', 'No tienes permiso para rechazar esta solicitud.');
        }

        // Cambiar el estado de la solicitud a "Rechazada" (estado id = 3, por ejemplo)
        $solicitud->update(['id_estado_solicitudes' => 3]);

        return redirect()->back()->with('success', 'Has rechazado la solicitud.');
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
