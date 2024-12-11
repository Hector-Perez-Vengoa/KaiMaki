<?php

use App\Models\User;
use Laravel\Jetstream\Features;

test('Se puede mostrar la pantalla de confirmación de contraseña.
', function () {
    $user = Features::hasTeamFeatures()
                    ? User::factory()->withPersonalTeam()->create()
                    : User::factory()->create();

    $response = $this->actingAs($user)->get('/user/confirm-password');

    $response->assertStatus(200);
});

test('la contraseña se puede confirmar
', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/user/confirm-password', [
        'password' => 'password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
});

test('La contraseña no está confirmada con una contraseña no válida.
', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/user/confirm-password', [
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
});
