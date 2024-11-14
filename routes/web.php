<?php
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Rutas para el dashboard genérico (protegido para usuarios autenticados)
=======
/** 

Route::get('/', function () {
    return view('welcome');
});
*/
>>>>>>> 8b42386c715adda944480067e0f718867623161d
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::view('/trabajador/formulario', 'trabajador.formulario')->name('trabajador.formulario');
    Route::view('/cliente/formulario', 'cliente.formulario')->name('cliente.formulario');

});

<<<<<<< HEAD










=======
Route::get('/', function () {
    return view('welcome');
})->name('home');

    // Rutas para el dashboard del trabajador
Route::get('/trabajador/index', [TrabajadorController::class, 'index'])->name('trabajador.index');

    // Rutas para el dashboard del cliente
Route::get('/cliente/index', [ClienteController::class, 'index'])->name('cliente.index');

    // Rutas para el dashboard del Servicio
Route::get('/servicios', [ServiceController::class, 'servicios'])->name('servicios');
>>>>>>> 8b42386c715adda944480067e0f718867623161d
