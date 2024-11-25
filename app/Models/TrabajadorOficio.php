<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrabajadorOficio extends Model
{
    use HasFactory;

    protected $table = 'trabajadores_oficio'; // Nombre de la tabla
    protected $primaryKey = 'id_trabajador_oficio'; // Clave primaria
     // Si estás usando timestamps
    protected $fillable = [
        'id_trabajadores',
        'id_oficios',
    ];

}
