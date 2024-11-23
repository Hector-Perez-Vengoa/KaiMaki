<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajadores extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'trabajadores';

    // Clave primaria de la tabla
    protected $primaryKey = 'id_trabajadores';

    // Atributos que se pueden asignar en masa
    protected $fillable = [
        'dni',
        'nombres',
        'apellidos',
        'puntuacion',
        'telefono',
        'sexo',
        'id_ubicacion',
        'id_usuario',
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion', 'id_ubicacion');
    }

    
    public function antecedentes()
    {
    return $this->hasMany(Antecedentes::class, 'id_trabajadores', 'id_trabajadores');
    }

    public function certificados()
    {
        return $this->hasMany(Certificados::class, 'id_trabajadores', 'id_trabajadores');
    }


    public function oficios()
    {
        return $this->belongsToMany(Oficios::class, 'trabajadores_oficio', 'id_trabajadores', 'id_oficios');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    

}

