<?php
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UsuarioController;
use App\Models\Trabajadores;
use Illuminate\Support\Facades\Route;

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
        return view('dashboard');
    })->name('dashboard');
    

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
    // Rutas específicas para clientes
Route::middleware(['auth', 'role:3'])->group(function () {
        Route::get('/cliente/formulario', [ClienteController::class, 'formulario'])->name('cliente.formulario');
        Route::get('/servicios', [ServiceController::class, 'servicios'])->name('servicios');
    });
    
    // Rutas específicas para trabajadores
Route::middleware(['auth', 'role:2'])->group(function () {
        Route::post('/trabajadores', [TrabajadorController::class, 'store'])->name('trabajadores.store');
        //Route::view('/trabajador/formulario', 'trabajador.formulario')->name('trabajador.formulario');
        Route::get('/trabajador/formulario', [TrabajadorController::class, 'formulario'])->name('trabajador.formulario'); 
        Route::get('/trabajador/show', [TrabajadorController::class, 'show'])->name('trabajador.show');
      
    });

});













