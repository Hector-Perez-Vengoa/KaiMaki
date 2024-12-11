<?php
namespace App\Actions\Fortify;

use App\Models\EstadoUsers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'id_roles' => ['required'],  // Validar que el rol existe
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'id_roles' => $input['id_roles'],
            // Activo si es Cliente (id_roles = 3), Pendiente en caso contrario
            'id_estado_users' => ($input['id_roles'] == 3) ? 1 : 2,
            'password' => Hash::make($input['password']),
        ]);

    }
}
