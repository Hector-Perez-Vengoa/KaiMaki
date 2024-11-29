<?php

return [
    'auth' => \App\Http\Middleware\RedirectToDashboard::class,
    'role' => \App\Http\Middleware\RoleMiddleware::class,
    // Alias para tu middleware
    //'ensure.client.profile.complete' => \App\Http\Middleware\EnsureClientProfileComplete::class,
];
