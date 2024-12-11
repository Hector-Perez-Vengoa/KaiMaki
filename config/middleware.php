<?php

return [
    'auth' => \App\Http\Middleware\RedirectToDashboard::class,
    'role' => \App\Http\Middleware\RoleMiddleware::class,
    'worker.status' => \App\Http\Middleware\CheckEstadoTrabajador::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    // Alias para tu middleware
    //'ensure.client.profile.complete' => \App\Http\Middleware\EnsureClientProfileComplete::class,
];
