<?php
namespace App\Actions\Fortify;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
{
    // Para verificar que 'roles_id' llega al backend
    
    // Validación de los datos
    Validator::make($input, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => $this->passwordRules(),
        'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
    ])->validate();

    // Crear el usuario
    $user = User::create([
        'name' => $input['name'],
        'email' => $input['email'],
        'id_roles' => $input['roles_id'],   // Guarda el ID del rol en la columna 'id_roles' de la tabla 'users'
        'password' => Hash::make($input['password']),
    ]);

    // Asignar el rol al usuario
    // Si roles_id es el ID de la tabla roles, lo puedes pasar directamente
   // $user->assignRole($input['roles_id']);  // Asume que 'roles_id' es un número y el método `assignRole` puede trabajar con el ID

    // Devolver el usuario creado
    return $user;
}
}
