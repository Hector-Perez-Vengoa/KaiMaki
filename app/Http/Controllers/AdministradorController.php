<?php

namespace App\Http\Controllers;

use App\Models\Antecedentes;
use App\Models\Certificados;
use App\Models\Cliente;
use App\Models\EstadoAntecedentes;
use App\Models\EstadoCertificados;
use App\Models\EstadoUsers;
use App\Models\Trabajadores;
use App\Models\User;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('administrador.dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $tipo)
    {
        if ($tipo === 'trabajador') {
            // Buscar por id_usuario en lugar de id_trabajadores
            $usuario = Trabajadores::with(['users', 'oficios', 'certificados.estado', 'antecedentes.estado'])
            ->where('id_usuario', $id)
                ->first();

            $rol = 'Trabajador';
        } elseif ($tipo === 'cliente') {
            // Buscar por id_usuario en lugar de id_cliente
            $usuario = Cliente::with(['users', 'ubicacion'])
            ->where('id_usuario', $id)
                ->first();

            $rol = 'Cliente';
        } else {
            abort(404, 'Tipo de usuario no válido.');
        }

        // Si no encuentra el registro
        if (!$usuario) {
            $usuario = (object) [
                // Propiedades comunes
                'nombres' => null,
                'apellidos' => null,
                'dni' => null,
                'telefono' => null,
                'sexo' => null,
                'users' => (object) ['email' => null],
                'estado' => null,

                // Propiedades específicas del cliente
                'nom_cliente' => null,
                'ape_cliente' => null,
                'telefo_cliente' => null,
                'ubicacion' => (object) [
                    'direccion' => null,
                    'distrito' => null,
                    'ciudad' => null,
                ],

                // Propiedades específicas del trabajador
                'antecedentes' => collect([]),
                'certificados' => collect([]),
            ];
        }
        $estados = EstadoUsers::all(); // Asegúrate de cargar todos los estados
           // Obtener estados de las tablas relacionadas
        $estadosAntecedentes = EstadoAntecedentes::all(); // Estados de antecedentes
        $estadosCertificados = EstadoCertificados::all(); // Estados de certificado
        return view('administrador.usuarios.show', compact('usuario', 'rol','estados','estadosAntecedentes', 'estadosCertificados'));
    }



    public function validarTrabajador($id)
    {
        $trabajador = Trabajadores::findOrFail($id);
        $trabajador->user->id_estado_users = 1; // Cambia el estado a Activo
        $trabajador->user->save();

        // Redirigir de vuelta al perfil del trabajador con un mensaje de éxito
        return redirect()->route('administrador.usuarios.show', ['id' => $id])
            ->with('success', 'El trabajador ha sido validado con éxito.');
    }

    public function cambiarEstado(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        // Validar que el estado enviado es válido
        $request->validate([
            'id_estado_users' => 'required|exists:estado_users,id_estado_users',
        ]);

        // Actualizar el estado del usuario
        $usuario->id_estado_users = $request->id_estado_users;
        $usuario->save();

        // Define un mensaje flash
        session()->flash('success', 'El estado se ha actualizado correctamente.');
        // Redirige de vuelta a la vista anterior
        return redirect()->back();

        return redirect()->route('administrador.usuario.show', ['id' => $usuario->id, 'tipo' => $usuario->id_roles == 2 ? 'trabajador' : 'cliente'])
        ->with('success', 'El estado del usuario ha sido actualizado correctamente.');
    }

    public function cambiarEstadoDocumento(Request $request, $id)
    {
        // Validar que se haya enviado el tipo de entidad y el estado
        $request->validate([
            'tipo' => 'required|in:antecedente,certificado',
            'estado_id' => 'required',
        ]);

        // Determinar tabla y modelo basado en el tipo
        $table = $request->tipo === 'antecedente' ? 'estado_antecedentes' : 'estado_certificados';
        $column = $request->tipo === 'antecedente' ? 'id_estado_antecedentes' : 'id_estado_certificados';
        $model = $request->tipo === 'antecedente' ? Antecedentes::class : Certificados::class;

        // Validar que el estado exista en la tabla correspondiente
        $request->validate([
            'estado_id' => "exists:$table," . ($request->tipo === 'antecedente' ? 'id_estado_antecedentes' : 'id_estado_certificados')
        ]);

        // Buscar y actualizar la entidad
        $entidad = $model::findOrFail($id);
        $entidad->{$column} = $request->estado_id;
        $entidad->save();

        // Mensaje de éxito
        $mensaje = $request->tipo === 'antecedente'
            ? 'Estado del antecedente actualizado correctamente.'
            : 'Estado del certificado actualizado correctamente.';

        return redirect()->back()->with('success', $mensaje);
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
