<?php
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});
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
    
    Route::get('/servicios', [ServiceController::class, 'servicios'])->name('servicios');
    
    // Rutas específicas para clientes
    Route::middleware(['auth','role:3'])->group(function () {
        Route::get('/servicios', [ServiceController::class, 'servicios'])->name('servicios');
        Route::get('/cliente/formulario', [ClienteController::class, 'formulario'])->name('cliente.formulario');

    });
    
    // Rutas específicas para trabajadores
    Route::middleware(['auth', 'role:2'])->group(function () {
        Route::post('/trabajadores', [TrabajadorController::class, 'store'])->name('trabajadores.store');
        
        Route::view('/trabajador/formulario', 'trabajador.formulario')->name('trabajador.formulario');
        Route::get('/trabajador/formulario', [TrabajadorController::class, 'formulario'])->name('trabajador.formulario');
    });

});













