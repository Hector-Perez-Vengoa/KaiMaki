<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProblemaController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UsuarioController;
use App\Http\Middleware\CheckProfileCompletion;
use App\Models\Trabajadores;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    });


    // Rutas específicas para Administrador
    Route::middleware(['auth', 'role:1'])->group(function () {
        Route::get('/admin/dashboard', function () { return view('administrador.dashboard.index');})->name('admin.dashboard');
        Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios.index');
         // Rutas del dashboard (Material Dashboard)
         Route::get('/administrador/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

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

        // Ruta para el perfil del usuario
        Route::get('/admin/user-profile', function () {
            return view('administrador.pages.laravel-examples.user-profile', ['activePage' => 'user-profile']);
        })->name('user-profile');

        // Ruta para la gestión de usuarios
        Route::get('/admin/user-management', function () {
            return view('administrador.pages.laravel-examples.user-management', ['activePage' => 'user-management']);
        })->name('user-management');

        // Ruta para notificaciones
        Route::get('/admin/notifications', function () {
            return view('administrador.pages.notifications', ['activePage' => 'notifications']);
        })->name('notifications');

        // Ruta para configuraciones adicionales
        Route::get('/admin/billing', function () {
            return view('administrador.pages.billing', ['activePage' => 'billing']);
        })->name('billing');

        Route::get('/admin/tables', function () {
            return view('administrador.pages.tables', ['activePage' => 'tables']);
        })->name('tables');
        Route::get('/admin/virtual-reality', function () {
            return view('administrador.pages.virtual-reality', ['activePage' => 'virtual-reality']);
        })->name('virtual-reality');

        Route::get('/admin/rtl', function () {
            return view('administrador.pages.rtl', ['activePage' => 'rtl']);
        })->name('rtl');
        Route::get('/admin/profile', function () {
            return view('administrador.pages.profile', ['activePage' => 'profile']);
        })->name('profile');
        Route::get('/admin/static-sign-in', function () {
            return view('administrador.pages.static-sign-in', ['activePage' => 'static-sign-in']);
        })->name('static-sign-in');
        Route::get('/admin/static-sign-up', function () {
            return view('administrador.pages.static-sign-up', ['activePage' => 'static-sign-up']);
        })->name('static-sign-up');



    });




    // Rutas específicas para trabajadores
    Route::middleware(['auth','role:2'])->group(function () {
        Route::get('/trabajador/dashboard', function () { return view('trabajador.dashboard');})->name('trabajador.dashboard');
        Route::get('/trabajador/formulario', [TrabajadorController::class, 'formulario'])->name('trabajador.formulario');
        Route::post('/trabajadores', [TrabajadorController::class, 'store'])->name('trabajadores.store');
        Route::get('/trabajador/solicitudes', [TrabajadorController::class, 'solicitudes'])->name('trabajador.solicitudes');
        Route::post('/solicitudes/{id_solicitud}/{estado}', [TrabajadorController::class, 'actualizarEstado'])->name('solicitudes.actualizarEstado');
        //Route::view('/trabajador/formulario', 'trabajador.formulario')->name('trabajador.formulario');
        Route::get('/trabajador/show', [TrabajadorController::class, 'show'])->name('trabajador.show');


    });
});

// Ruta de información "Sobre Nosotros"
Route::get('/about-us', function () {
    return view('Sobrenosotros.about-us');
});
