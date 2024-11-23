<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProblemaController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UsuarioController;
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
])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        // Redirige a completar el perfil si es cliente y no ha registrado su información
        if ($user->id_roles == 3 && !$user->cliente) {
            return redirect()->route('cliente.formulario')->with('error', 'Debes completar tu registro como cliente.');
        }

        return view('dashboard');
    })->name('dashboard');


    Route::get('/servicios', function () {
        $user = Auth::user();

        // Redirige a completar el perfil si es cliente y no ha registrado su información
        if ($user->id_roles == 3 && !$user->cliente) {
            return redirect()->route('cliente.formulario')->with('error', 'Debes completar tu registro como cliente.');
        }

        return view('servicios');
    })->name('servicios');

    // Rutas específicas para clientes
    Route::middleware(['auth','role:3'])->group(function () {
        Route::get('/servicios', [ServiceController::class, 'servicios'])->name('servicios');
        Route::post('/servicios', [ServiceController::class, 'solicitar'])->name('servicios.solicitar');
        Route::get('/servicios/{id_trabajadores}', [ServiceController::class, 'elegir'])->name('servicios.serperfil');
        Route::get('/cliente/formulario', [ClienteController::class, 'formulario'])->name('cliente.formulario');
        Route::post('/cliente/formulario', [ClienteController::class, 'guardarFormulario'])->name('cliente.store');
        Route::get('/cliente/dashboard', function () {
            return view('dashboard');
        })->name('cliente.dashboard');
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
    Route::get('/administrador/trabajadores', [TrabajadorController::class, 'index'])->name('administrador.trabajador');
     // Ver detalles del trabajador
     
     Route::get('/administrador/trabajador/{id}', [TrabajadorController::class, 'show'])->name('administrador.trabajador.show');
     // Ruta para mostrar el formulario para cambiar el estado
     Route::get('/administrador/usuario/{id}/cambiar-estado', [UsuarioController::class, 'cambiarEstado'])->name('administrador.usuario.cambiarEstado');
 
     // Ruta para procesar el cambio de estado
     Route::post('/administrador/usuario/{id}/cambiar-estado', [UsuarioController::class, 'actualizarEstado'])->name('administrador.usuario.actualizarEstado');    
});

    
    // Rutas específicas para trabajadores
Route::middleware(['auth', 'role:2'])->group(function () {
        Route::post('/trabajadores', [TrabajadorController::class, 'store'])->name('trabajadores.store');
        //Route::view('/trabajador/formulario', 'trabajador.formulario')->name('trabajador.formulario');
        Route::get('/trabajador/formulario', [TrabajadorController::class, 'formulario'])->name('trabajador.formulario'); 
        Route::get('/trabajador/show', [TrabajadorController::class, 'show'])->name('trabajador.show');
      
    });

    // Rutas específicas para trabajadores
    Route::middleware(['auth', 'role:2'])->group(function () {
        Route::post('/trabajadores', [TrabajadorController::class, 'store'])->name('trabajadores.store');
        //Route::view('/trabajador/formulario', 'trabajador.formulario')->name('trabajador.formulario');
        Route::get('/trabajador/formulario', [TrabajadorController::class, 'formulario'])->name('trabajador.formulario'); 
        Route::get('/trabajador/show', [TrabajadorController::class, 'show'])->name('trabajador.show');
      
        Route::get('/trabajador/solicitudes', [TrabajadorController::class, 'solicitudes'])->name('trabajador.solicitudes');
        Route::post('/solicitudes/{id_solicitud}/{estado}', [TrabajadorController::class, 'actualizarEstado'])->name('solicitudes.actualizarEstado');
        
    });
});

// Ruta de información "Sobre Nosotros"
Route::get('/about-us', function () {
    return view('Sobrenosotros.about-us');
});

