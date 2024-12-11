<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Antecedentes;
use App\Models\Certificados;
use App\Models\EstadoUsers;
use App\Models\Oficios;
use App\Models\Trabajadores;
use App\Models\Ubicacion;
use App\Models\Solicitud;
use App\Models\Negociacion;
use App\Models\TrabajoCampo;
use App\Models\User;
use App\Notifications\CambiosNegociacion;
use Hamcrest\Core\AllOf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrabajadorController extends Controller
{

    public function index()
    {
        //
    }



    public function formulario()
    {
        $userId = Auth::id();
    // Cargar los oficios desde la base de datos
    $oficios = Oficios::all();
    $trabajadorDetails = Trabajadores::where('id_usuario', $userId)->first();
    // Pasar los oficios a la vista
    return view('trabajador.formulario', compact('oficios','trabajadorDetails'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $userId = Auth::id();

            // Verificar si el usuario ya completó el formulario
            $existingTrabajor = Trabajadores::where('id_usuario', $userId)->first();

            if ($existingTrabajor) {
                return redirect()->back()->with('error', 'Ya has registrado tus datos. No puedes enviarlo nuevamente.');
                }

            // 1. Validación
            $validatedData = $request->validate([
                'dni' => 'required|size:8|unique:trabajadores,dni',
                'nombres' => 'required|max:50',
                'apellidos' => 'required|max:50',
                'telefono' => 'required|size:9|unique:trabajadores,telefono',
                'sexo' => 'required|in:M,F',
                'direccion' => 'required|max:255',
                'distrito' => 'required|max:100',
                'ciudad' => 'required|max:100',
                'antecedente' => 'required|file|mimes:pdf|max:2048',
                'certificado' => 'nullable|file|mimes:pdf|max:2048',
                'oficios' => 'required|array',// Asegúrate de que se seleccionen oficios
                'oficios.*' => 'exists:oficios,id_oficios', // Validar que cada ID existe en la tabla oficios
                ],
                [
                    'antecedente.required' => 'El archivo de antecedentes es obligatorio.',
                    'antecedente.mimes' => 'El archivo de antecedentes debe ser un PDF.',
                    'antecedente.max' => 'El archivo de antecedentes no debe superar los 2 MB.',
                    'certificado.mimes' => 'El archivo de certificado debe ser un PDF.',
                    'certificado.max' => 'El archivo de certificado no debe superar los 2 MB.',
                ]
                );

            // 2. Crear ubicación
            $ubicacion = Ubicacion::create([
                'direccion' => $request->direccion,
                'distrito' => $request->distrito,
                'ciudad' => $request->ciudad
            ]);



            // 3. Crear trabajador
            $trabajador = Trabajadores::create([
                'dni' => $request->dni,
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'puntuacion' => 0, // Valor inicial
                'telefono' => $request->telefono,
                'sexo' => $request->sexo,
                'id_ubicacion' => $ubicacion->id_ubicacion,
                'id_usuario' => $userId,
            ]);
                // Asociar los oficios seleccionados
            $trabajador->oficios()->sync($request->oficios);
            // 4. Procesar y guardar antecedente
            if ($request->hasFile('antecedente')) {
                // Guardar el archivo del antecedente
                $pathAntecedente = $request->file('antecedente')->store('antecedentes', 'public');

                // Crear el antecedente y asociarlo al trabajador
                Antecedentes::create([
                    'documento_antecedente' => $pathAntecedente,
                    'id_trabajadores' => $trabajador->id_trabajadores, // Asociar el antecedente al trabajador
                    'id_estado_antecedentes' => 2, // Estado por defecto
                ]);
            }


            // 5. Procesar y guardar certificado
            if ($request->hasFile('certificado')) {
                $pathCertificado = $request->file('certificado')->store('certificados', 'public');

                Certificados::create([
                    'documento_certificado' => $pathCertificado,
                    'id_trabajadores' => $trabajador->id_trabajadores,
                    'id_estado_certificados' => 2 // Estado por defecto
                ]);
            }

            // 6. Confirmar la transacción
            DB::commit();

            // 7. Redirigir con mensaje de éxito
            return  redirect()->route('dashboard');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            // Registrar el error en el log para depuración
            \Illuminate\Support\Facades\Log::error('Error al registrar el trabajador:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Redirigir con un mensaje de error
            return redirect()->back()->with('error', 'Ocurrió un error al registrar el trabajador. Intente nuevamente.');
        }
    }
    public function show($id = null)
    {
        // ID del usuario autenticado
        $userId = Auth::id();

        // Verifica si el usuario está autenticado
        if (!empty(Auth::user())) {
            $user = Auth::user();

            // Flujo para Administrador
            if ($user->id_roles == 1) {
                // Carga directamente el modelo Trabajadores con todas sus relaciones necesarias
                $trabajador = Trabajadores::with([
                    'ubicacion',
                    'certificados.estado',
                    'antecedentes',
                    'oficios',
                    'users' // Para obtener datos del usuario asociado
                    ])->findOrFail($id);

                    // Retorna la vista con los datos del trabajador
                return view('trabajador.show', compact('trabajador'));
                }


            // Flujo para Trabajadores
            if ($user->id_roles == 2) {
                $trabajador = Trabajadores::with(['certificados.estado', 'ubicacion', 'antecedentes', 'oficios'])
                    ->where('id_usuario', $userId)
                    ->first();

                // Si no existe el trabajador o sus relaciones están vacías
                if (!$trabajador || ($trabajador->antecedentes->isEmpty() && $trabajador->certificados->isEmpty())) {
                    return redirect()->route('trabajador.formulario')
                        ->with('error', 'No se encontraron datos registrados. Por favor, complete el formulario.');
                }

                // Retorna la vista con los datos del trabajador
                return view('trabajador.show', compact('trabajador'));
            }
        }
    }
    public function solicitudes(Request $request)
    {
        // Obtener el usuario autenticado
        $usuario = Auth::user();

        // Obtener el ID del trabajador asociado al usu ario autenticado
        $trabajador = $usuario->trabajador()->first();
        $idTrabajador = $trabajador->id_trabajadores;

        // Obtener el estado a filtrar desde la solicitud
        $estado = $request->input('estado');

        // Iniciar la consulta base
        $query = Solicitud::where('id_trabajadores', $idTrabajador)
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
        return view('trabajador.solicitudes', compact('solicitudes'));
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


    public function negociacion(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'id_solicitudes' => 'required',
            'monto' => 'required|min:0',
            'nueva_fech_reserva' => 'required|date',
            'hora_inicio' => 'required',
            'tiempo_estimado' => 'required',
            'mensaje' => 'required',
        ]);

        // Crear una nueva negociación
        Negociacion::create([
            'id_solicitudes' => $validatedData['id_solicitudes'],
            'monto' => $validatedData['monto'],
            'nueva_fech_reserva' => $validatedData['nueva_fech_reserva'],
            'hora_inicio' => $validatedData['hora_inicio'],
            'tiempo_estimado' => $validatedData['tiempo_estimado'],
            'mensaje' => $validatedData['mensaje'],
        ]);

        // Realizar la actualización de estado
        Solicitud::where('id_solicitudes', $validatedData['id_solicitudes'])
                    ->update(['id_estado_solicitudes' => 5]);

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'La negociación se ha registrado correctamente.');
    }

    public function verProblemas()
    {
        // Verificar que el usuario autenticado sea un trabajador
        $trabajador = Auth::user()->trabajadores;

        if (!$trabajador) {
            return redirect()->route('trabajador.dashboard')->with('error', 'No tienes un perfil completo.');
        }

        // Obtener todos los problemas sin filtrar por oficios
        $problemas = Problema::with(['cliente', 'oficio', 'estadoProblema'])->get();

        return view('trabajador.trabajos.trabajos', compact('problemas'));
    }

    public function verDetalleProblema($id)
{
    $problema = Problema::with(['oficio', 'cliente', 'estadoProblema'])->findOrFail($id);

    return view('trabajador.trabajos.detalle_problema', compact('problema'));
}
public function solicitarTrabajo($problemaId)
{
    $trabajador = Auth::user()->trabajadores;

    if (!$trabajador) {
        return redirect()->back()->with('error', 'No tienes un perfil completo para realizar esta acción.');
    }

    $problema = Problema::findOrFail($problemaId);

    // Verificar si el problema tiene un cliente asociado
    if (!$problema->id_cliente) {
        return redirect()->back()->with('error', 'El problema no tiene un cliente asociado.');
    }

    // Crear una solicitud en la tabla `solicitudes`
    Solicitud::create([
        'id_estado_solicitudes' => 1, // Estado inicial: Pendiente
        'id_trabajadores' => $trabajador->id_trabajadores,
        'id_cliente' => $problema->id_cliente,
        'id_problema' => $problema->id_problemas, // Guardar la relación con el problema
        'fech_reserva' => $problema->fecha_reserva,
        'descripcion' => $problema->descripcion,
        'hora_inicio_propuesta' => now()->format('H:i:s'),
    ]);

    return redirect()->route('trabajador.solicitudes')->with('success', 'Has solicitado el trabajo correctamente.');
}

public function verNegociaciones()
{
    $trabajador = Auth::user()->trabajadores;

    if (!$trabajador) {
        return redirect()->route('trabajador.dashboard')->with('error', 'No tienes un perfil completo.');
    }

    // Obtener las solicitudes aceptadas que involucran al trabajador
    $negociaciones = Negociacion::whereHas('solicitud', function ($query) use ($trabajador) {
        $query->where('id_trabajadores', $trabajador->id_trabajadores)
              ->where('id_estado_solicitudes', 2); // Estado: Aceptada
    })->get();

    return view('trabajador.mensajeria.lista', compact('negociaciones'));
}








}
