<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'trabajadores';

    // Clave primaria de la tabla
    protected $primaryKey = 'id_trabajador';

    // Atributos que se pueden asignar en masa
    protected $fillable = [
        'nombres_t',
        'apellidos_t',
        'oficio_tmp',
        'puntuacion',
        'telefono',
        'tipo_documento',
        'num_documento'
    ];

}

