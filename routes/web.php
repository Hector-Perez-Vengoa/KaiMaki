<?php
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});




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

    Route::view('/trabajador/formulario', 'trabajador.formulario')->name('trabajador.formulario');
    Route::view('/cliente/formulario', 'cliente.formulario')->name('cliente.formulario');

});

Route::get('/about-us', function () {
    return view('Sobrenosotros.about-us');
});








