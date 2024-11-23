<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProblemaController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rutas protegidas por autenticación
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    // Dashboard genérico
    Route::get('/dashboard', function () {
        $user = Auth::user();

        // Redirige a completar el perfil si es cliente y no ha registrado su información
        if ($user->id_roles == 3 && !$user->cliente) {
            return redirect()->route('cliente.formulario')->with('error', 'Debes completar tu registro como cliente.');
        }

        return view('dashboard');
    })->name('dashboard');

    // Rutas específicas para clientes
    Route::middleware(['role:3'])->group(function () {
        // Formulario y dashboard de cliente
        Route::get('/cliente/formulario', [ClienteController::class, 'formulario'])->name('cliente.formulario');
        Route::post('/cliente/formulario', [ClienteController::class, 'guardarFormulario'])->name('cliente.store');
        Route::get('/cliente/dashboard', function () {
            return view('cliente.dashboard');
        })->name('cliente.dashboard');



        // Protección para la vista de servicios
        Route::get('/servicios', [ServiceController::class, 'servicios'])->name('servicios');
    });

    Route::middleware(['role:3'])->group(function () {
        Route::get('/cliente/publicar-problema', [ProblemaController::class, 'create'])->name('problemas.create');
        Route::post('/cliente/publicar-problema', [ProblemaController::class, 'store'])->name('problemas.store');
        Route::get('/cliente/mis-problemas', [ProblemaController::class, 'index'])->name('cliente.problemas.index');
        Route::get('/problemas/{problema}', [ProblemaController::class, 'show'])->name('problemas.show');
        Route::get('/problemas/{problema}/edit', [ProblemaController::class, 'edit'])->name('problemas.edit');
        // Ruta para actualizar los datos del problema
        Route::put('/problemas/{problema}', [ProblemaController::class, 'update'])->name('problemas.update');
    
    });
    

    // Rutas específicas para trabajadores
    Route::middleware(['role:2'])->group(function () {
        Route::get('/trabajador/formulario', [TrabajadorController::class, 'formulario'])->name('trabajador.formulario');
        Route::post('/trabajadores', [TrabajadorController::class, 'store'])->name('trabajadores.store');
    });
});

// Ruta de información "Sobre Nosotros"
Route::get('/about-us', function () {
    return view('Sobrenosotros.about-us');
});
