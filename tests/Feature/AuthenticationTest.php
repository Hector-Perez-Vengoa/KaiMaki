<?php

use App\Models\User;

test('La pantalla de inicio de sesión se puede representar.
', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('Los usuarios pueden autenticarse usando la pantalla de inicio de sesión.', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('los usuarios no pueden autenticarse con una contraseña no válida
', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});
