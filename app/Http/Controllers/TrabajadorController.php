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
use App\Models\User;
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


    public function reportes()
    {
        return view('trabajador.reportes'); // Crear la vista
    }

    public function solicitudes()
    {
        // Obtener el usuario autenticado
        $idTrabajador = Auth::user()->trabajadores->id_trabajadores;

        // Obtener las solicitudes filtradas por el ID del trabajador
        $solicitudes = Solicitud::where('id_trabajadores', $idTrabajador)
        ->with(['cliente', 'estado']) // Cargar relaciones
        ->get();

        // Pasar las solicitudes a la vista
        return view('trabajador.solicitudes', compact('solicitudes'));

    }

    public function actualizarEstado($id_solicitud, $estado)
    {

        // Realizar la actualización directamente
        Solicitud::where('id_solicitudes', $id_solicitud)->update(['id_estado_solicitudes' => $estado]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('trabajador.solicitudes')->with('success', 'Estado actualizado correctamente.');
    }




}
