<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProblemaController;
use App\Http\Controllers\ReclamoController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UsuarioController;
use App\Http\Middleware\CheckProfileCompletion;
use App\Models\Administrador;
use App\Models\Trabajadores;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// Rutas para el dashboard genérico (protegido para usuarios autenticados)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    CheckProfileCompletion::class
])->group(function () {


    // Dashboard genérico
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->id_roles == 1) {
            return view('administrador.dashboard.index');
        } elseif ($user->id_roles == 3) {
            return view('cliente.dashboard');
        } elseif ($user->id_roles == 2) {
            return view('trabajador.dashboard');
        }

        return redirect('/')->with('error', 'No tienes un rol asignado.');
    })->name('dashboard');


    // Ruta para servicios, bloqueado, solo para clientes registrados
    Route::get('/servicios', function () {
        $user = Auth::user();
        // Redirige a completar el perfil si es cliente y no ha registrado su información
        if ($user->id_roles == 3 && !$user->cliente) {
            return redirect()->route('cliente.formulario')->with('error', 'Debes completar tu registro como cliente.');
        }
        return view('servicios');
    })->name('servicios');

    // Rutas específicas para clientes
    Route::middleware(['auth','role:3'])->group(function ()
    {
        Route::get('/cliente/dashboard', function () { return view('cliente.dashboard');})->name('cliente.dashboard');
        Route::get('/servicios', [ServiceController::class, 'servicios'])->name('servicios');
        Route::post('/servicios', [ServiceController::class, 'solicitar'])->name('servicios.solicitar');
        Route::get('/servicios/{id_trabajadores}', [ServiceController::class, 'elegir'])->name('servicios.serperfil');
        Route::get('/cliente/formulario', [ClienteController::class, 'formulario'])->name('cliente.formulario');
        Route::post('/cliente/formulario', [ClienteController::class, 'guardarFormulario'])->name('cliente.store');
        Route::get('/cliente/publicar-problema', [ProblemaController::class, 'create'])->name('problemas.create');
        Route::post('/cliente/publicar-problema', [ProblemaController::class, 'store'])->name('problemas.store');
        Route::get('/cliente/mis-problemas', [ProblemaController::class, 'index'])->name('cliente.problemas.index');
        Route::get('/problemas/{problema}', [ProblemaController::class, 'show'])->name('problemas.show');
        Route::get('/problemas/{problema}/edit', [ProblemaController::class, 'edit'])->name('problemas.edit');
        // Ruta para actualizar los datos del problema
        Route::put('/problemas/{problema}', [ProblemaController::class, 'update'])->name('problemas.update');
        Route::get('/cliente/solicitudes', [ClienteController::class, 'solicitudes'])->name('cliente.solicitudes');

        // Ruta para renegociar una solicitud
        Route::post('/cliente/solicitudes/renegociar', [ClienteController::class, 'renegociar'])->name('cliente.renegociar');
        Route::post('/cliente/solicitudes/puntuacion', [ClienteController::class, 'puntuacion'])->name('cliente.puntuacion');

        Route::post('/cliente/solicitudes', [ClienteController::class, 'actualizarEstado'])->name('cliente.actualizarEstado');





        Route::put('/problemas/{id}/marcar-urgente', [ProblemaController::class, 'marcarUrgente'])->name('problemas.marcarUrgente');
        Route::delete('/problemas/{problema}', [ProblemaController::class, 'destroy'])->name('problemas.destroy');

        //Realiza reclamo
        Route::get('/cliente/reclamo', [ReclamoController::class, 'create'])->name('cliente.reclamo.create');
        Route::post('/cliente/reclamo', [ReclamoController::class, 'store'])->name('cliente.reclamo.store');
    });


    // Rutas específicas para Administrador
    Route::middleware(['auth', 'role:1'])->group(function () {
        // Ruta para el perfil y registro
        // Ruta para mostrar el formulario
        Route::get('/administrador/formulario', [AdministradorController::class, 'formulario'])->name('administrador.formulario');
        // Ruta para guardar los datos
        Route::post('/administrador/store', [AdministradorController::class, 'store'])->name('administrador.store');
        Route::get('/administrador/profile', [AdministradorController::class, 'showProfile'])->name('admin.perfil');//ver
        //Para cambiar su imgen
        Route::post('/admin/update-photo', [AdministradorController::class, 'updatePhoto'])->name('admin.update.photo');
        Route::post('/admin/update-background', [AdministradorController::class, 'updateBackground'])->name('admin.update.background');



        Route::get('/admin/dashboard', function () { return view('administrador.dashboard.index');})->name('admin.dashboard');
        Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios.index');
         // Rutas del dashboard (Material Dashboard)
         Route::get('/administrador/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
         // Ruta para la gestión de usuarios
         Route::get('/administrador/usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios.index');
         // Ver detalles del usuario
         Route::get('/administrador/usuarios/{id}/{tipo}', [AdministradorController::class, 'show'])->name('administrador.usuario.show');
         // Ruta para cambiar el estado
         Route::put('/admin/usuario/{id}/cambiar-estado', [AdministradorController::class, 'cambiarEstado'])
         ->name('administrador.usuario.cambiarEstado');
         // Ruta para procesar el cambio de estado
         Route::post('/administrador/usuario/{id}/cambiar-estado', [UsuarioController::class, 'actualizarEstado'])->name('administrador.usuario.actualizarEstado');

        Route::post('/admin/trabajador/{id}/validar', [TrabajadorController::class, 'validarTrabajador'])->name('administrador.trabajador.validar');
        // Ruta para actualizar el estado de un antecedente
        Route::put('/administrador/documento/{id}/cambiar-estado', [AdministradorController::class, 'cambiarEstadoDocumento'])->name('administrador.actualizar.estado');
        //Ruta para ver todos los reclamos de los publicados por los usuarios
        Route::get('/admin/reclamos', [AdministradorController::class, 'indexReclamos'])->name('reclamos.index');

        //Ruta para administrar los reclamos
        Route::get('administrador/reclamos/{id}', [AdministradorController::class, 'verReclamo'])->name('administrador.reclamos.ver');
        Route::put('administrador/reclamos/{id}', [AdministradorController::class, 'cambiarReclamo'])->name('administrador.reclamos.update');

        //Ruta para gestionar los oficios
        Route::get('administrador/oficios', [AdministradorController::class, 'indexOficio'])->name('administrador.oficios.ver');
        // Ruta para almacenar un nuevo oficio
        Route::post('/oficios', [AdministradorController::class, 'almacenarOficio'])->name('administrador.almacenar-oficio');
        // Ruta para mostrar el formulario de edición de un oficio
        Route::get('/oficios/{id_oficios}/editar', [AdministradorController::class, 'editarOficio'])->name('administrador.editar-oficio');
        // Ruta para actualizar un oficio existente
         Route::put('/oficios/{id_oficios}', [AdministradorController::class, 'actualizarOficio'])->name('administrador.actualizar-oficio');
        // Ruta para eliminar un oficio
        Route::delete('/oficios/{id_oficios}', [AdministradorController::class, 'eliminarOficio'])->name('administrador.eliminar-oficio');

        // Ruta para gestionar las solicitudes
        Route::get('/administrador/solicitud', [AdministradorController::class, 'verSolicitudes'])->name('administrador.ver-solicitudes');

        //Ruta para gestionar los problemas
        Route::get('/administrador/problemas', [AdministradorController::class, 'verProblemas'])->name('administrador.ver-problemas');

        //Para ver las notificaciones
        Route::get('/admin/notifications', [AdministradorController::class, 'verNotificaciones'])->name('notifications');
        Route::get('/admin/notifications/read/{id}', [AdministradorController::class, 'marcarNotificacionLeida'])->name('admin.markNotificationRead');
    });




    // Rutas específicas para trabajadores
    Route::middleware(['auth','role:2'])->group(function () {
        Route::get('/trabajador/dashboard', function () { return view('trabajador.dashboard');})->name('trabajador.dashboard');
        Route::get('/trabajador/formulario', [TrabajadorController::class, 'formulario'])->name('trabajador.formulario');
        Route::post('/trabajadores', [TrabajadorController::class, 'store'])->name('trabajadores.store');
        Route::get('/trabajador/solicitudes', [TrabajadorController::class, 'solicitudes'])->name('trabajador.solicitudes');
        Route::post('/trabajador/actualizarEstado', [TrabajadorController::class, 'actualizarEstado'])->name('trabajador.actualizarEstado');
        //Route::view('/trabajador/formulario', 'trabajador.formulario')->name('trabajador.formulario');
        Route::get('/trabajador/show', [TrabajadorController::class, 'show'])->name('trabajador.show');
        Route::post('/trabajador/solicitudes', [TrabajadorController::class, 'negociacion'])->name('trabajador.negociacion');
        //El trabajador registra su reclamo
        Route::get('/trabajadores/reclamo', [ReclamoController::class, 'create'])->name('trabajador.reclamo.create');
        Route::post('/trabajadores/reclamo', [ReclamoController::class, 'store'])->name('trabajador.reclamo.store');


    });
});

// Ruta de información "Sobre Nosotros"
Route::get('/about-us', function () {
    return view('Sobrenosotros.about-us');
});
