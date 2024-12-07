<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Notifications\Notification;
use App\Models\Antecedentes;
use App\Models\Certificados;
use App\Models\Cliente;
use App\Models\EstadoAntecedentes;
use App\Models\EstadoCertificados;
use App\Models\EstadoReclamos;
use App\Models\EstadoUsers;
use App\Models\Oficios;
use App\Models\Problema;
use App\Models\Reclamos;
use App\Models\Solicitud;
use App\Models\Trabajadores;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

     public function formulario()
     {
         $user = Auth::user();

         // Verificar si ya tiene un registro en la tabla administrador
         if ($user->administrador) {
             return redirect()->route('admin.perfil')->with('error', 'Ya tienes registrado tus datos.');
         }

         return view('administrador.register.formulario');
     }


     // Guardar datos
     public function store(Request $request)
{
    $user = Auth::user();

    // Verificar si ya tiene un registro
    if ($user->administrador) {
        return redirect()->route('admin.perfil')->with('error', 'Ya tienes registrado tus datos.');
    }

    // Validar los datos
    $request->validate([
        'dni' => 'required|numeric|digits:8|unique:administrador,dni',
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'telefono' => 'required|numeric|digits_between:7,15',
    ]);

    // Crear el registro en la tabla administrador
    $administrador = new Administrador();
    $administrador->dni = $request->dni;
    $administrador->nombres = $request->nombres;
    $administrador->apellidos = $request->apellidos;
    $administrador->telefono = $request->telefono;
    $administrador->id_usuario = $user->id;
    $administrador->save();

    return redirect()->route('admin.perfil')->with('success', 'Tus datos han sido registrados correctamente.');
}


    //ver perfil
    public function showProfile()
{
    $user = Auth::user();

    // Verificar que el administrador tenga datos registrados
    if (!$user->administrador) {
        return redirect()->route('administrador.formulario')->with('error', 'Por favor, completa tu perfil.');
    }

    return view('administrador.register.show', [
        'user' => $user,
        'administrador' => $user->administrador,
    ]);
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
        return view('administrador.usuarios.show', compact('usuario', 'rol', 'estados', 'estadosAntecedentes', 'estadosCertificados'));
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

//Funciones para administrar reclamos

    public function indexReclamos()
    {
        $reclamos = Reclamos::with(['users', 'estado'])->get();

        return view('administrador.reclamos.index', compact('reclamos'));
    }

    public function verReclamo($id)
    {

        // Buscamos el reclamo junto con la información del usuario
        $reclamo = Reclamos::with(['users.clientes', 'users.trabajadores', 'estado'])->findOrFail($id);
        $estados = EstadoReclamos::all();

        // Retornamos la vista y pasamos la información del reclamo a la misma
        return view('administrador.reclamos.show', compact('reclamo', 'estados'));
    }

    public function cambiarReclamo(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:Pendiente,En proceso,Resuelto',
        ]);

        $reclamo = Reclamos::findOrFail($id);
        $reclamo->estado = $request->estado;
        $reclamo->save();
    }

//Funciones para administrar los Oficios
    public function indexOficio()
    {
        $oficios = Oficios::all();

        return view('administrador.oficios.index', compact('oficios'));
    }

    // Método para almacenar un nuevo oficio
    public function almacenarOficio(Request $request)
    {
        $request->validate([
            'nombre_oficio' => 'required|string|max:100',
        ]);

        Oficios::create($request->all());

        return redirect()->route('administrador.oficios.ver')->with('success', 'Oficio creado correctamente.');
    }

    // Método para actualizar un oficio existente
    public function actualizarOficio(Request $request, $id)
    {
        $request->validate([
            'nombre_oficio' => 'required|string|max:100',
        ]);

        $oficio = Oficios::findOrFail($id);
        $oficio->update($request->all());

        return redirect()->route('administrador.oficios.ver')->with('success', 'Oficio actualizado correctamente.');
    }

    // Método para eliminar un oficio
    public function eliminarOficio($id)
    {
        $oficio = Oficios::findOrFail($id);
        $oficio->delete();

        return redirect()->route('administrador.oficios.ver')->with('success', 'Oficio eliminado correctamente.');
    }


    public function verSolicitudes()
    {
        $solicitudes = Solicitud::with(['cliente', 'trabajador', 'estado'])->get();
        return view('administrador.solicitud.index', compact('solicitudes'));
    }

    public function verProblemas()
    {
        $problemas = Problema::with(['cliente', 'oficio', 'estadoProblema'])->get();
        return view('administrador.problema.index', compact('problemas'));
    }
    public function verNotificaciones()
    {
        $notificaciones = Auth::user()->notifications;
        return view('administrador.notification.notificacion', compact('notificaciones'))->with('activePage', 'notifications');
    }



    public function marcarNotificacionLeida($id)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Buscar la notificación en las no leídas
        $notificacion = $user->unreadNotifications->where('id', $id)->first();

        if ($notificacion) {
            // Marcar como leída
            $notificacion->markAsRead();
        }

        return redirect()->route('notifications')->with('success', 'Notificación marcada como leída.');
    }

public function updatePhoto(Request $request)
{
    $request->validate([
        'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $user = Auth::user();
    $administrador = $user->administrador;

    // Eliminar la foto anterior si existe
    if ($administrador->profile_photo) {
        Storage::delete($administrador->profile_photo);
    }

    // Guardar la nueva foto
    $path = $request->file('profile_photo')->store('profile_photos');

    $administrador->profile_photo = $path;
    $administrador->save();

    return redirect()->back()->with('success', 'Foto de perfil actualizada correctamente.');
}

public function updateBackground(Request $request)
{
    $request->validate([
        'background_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $user = Auth::user();
    $administrador = $user->administrador;

    // Eliminar la imagen anterior si existe
    if ($administrador->background_image) {
        Storage::delete($administrador->background_image);
    }

    // Guardar la nueva imagen de fondo
    $path = $request->file('background_image')->store('background_images');

    $administrador->background_image = $path;
    $administrador->save();

    return redirect()->back()->with('success', 'Imagen de fondo actualizada correctamente.');
}
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
