<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'id_roles',

        'password',
        'is_online',

    ];
    // Relación con el modelo Rol (Usuario pertenece a un Rol)
    public function rol()
        {//cambie el id_roles con id por que no es necesario definir el id_roles ya que en la tabla roles el id no esta personalizado
            return $this->belongsTo('App\Models\Rol', 'id_roles', 'id');
        }

    public function trabajadores()
        {
            return $this->hasOne(Trabajadores::class, 'id_usuario', 'id');
        }

    public function clientes()
        {
            return $this->hasOne(Cliente::class, 'id_usuario', 'id');
        }

    public function administrador()
        {
            return $this->hasOne(Administrador::class, 'id_usuario', 'id');
        }
    public function estado()
        {
            return $this->belongsTo('App\Models\EstadoUsers', 'id_estado_users', 'id_estado_users');
        }

    public function certificados()
        {
            return $this->hasManyThrough(
                Certificados::class,
                Trabajadores::class,
                'id_usuario', // Foreign key en la tabla 'trabajadores'
                'id_trabajadores', // Foreign key en la tabla 'certificados'
                'id', // Local key en la tabla 'users'
                'id_trabajadores' // Local key en la tabla 'trabajadores'
            );
        }

    public function antecedentes()
        {
            return $this->hasManyThrough(
                Antecedentes::class,
                Trabajadores::class,
                'id_usuario', // Foreign key en la tabla 'trabajadores'
                'id_trabajadores', // Foreign key en la tabla 'antecedentes'
                'id', // Local key en la tabla 'users'
                'id_trabajadores' // Local key en la tabla 'trabajadores'
            );
        }
        public function oficios()
        {
            return $this->hasManyThrough(
                Oficios::class,
                Trabajadores::class,
                'id_usuario',       // Foreign key en 'trabajadores'
                'id_oficios',       // Foreign key en 'oficios' (a través de tabla intermedia)
                'id',               // Local key en 'users'
                'id_trabajadores'   // Local key en 'trabajadores'
            );
        }

        public function ubicacion()
    {
        return $this->hasOneThrough(
            Ubicacion::class,
            Trabajadores::class,
            'id_usuario',       // Foreign key en 'trabajadores'
            'id_ubicacion',     // Foreign key en 'ubicacion'
            'id',               // Local key en 'users'
            'id_ubicacion'      // Local key en 'trabajadores'
        );
    }

    public function reclamo()
    {
        return $this->hasMany(Reclamos::class, 'id_usuario','id');
    }






    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'roles_id' => 'integer',
        ];
    }

    // app/Models/User.php
    public function cliente()
    {
       return $this->hasOne(Cliente::class, 'id_usuario', 'id');
    }



}
