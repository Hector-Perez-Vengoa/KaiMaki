<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TrabajadorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rutas para el dashboard (solo accesibles para usuarios autenticados)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

    // Rutas para el dashboard del trabajador
Route::get('/trabajador/index', [TrabajadorController::class, 'index'])->name('trabajador.index');

    // Rutas para el dashboard del cliente
Route::get('/cliente/index', [ClienteController::class, 'index'])->name('cliente.index');
