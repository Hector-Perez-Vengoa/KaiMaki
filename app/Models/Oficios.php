<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficios extends Model
{
    use HasFactory;

    protected $table = 'oficios'; // Nombre de la tabla
    protected $primaryKey = 'id_oficios'; // Clave primaria personalizada
    public $incrementing = true; // Si la clave primaria es auto-incremental
    protected $keyType = 'int'; // Tipo de clave primaria (entero)
    public function trabajadores()
    {
        return $this->belongsToMany(Trabajadores::class, 'trabajadores_oficio', 'id_oficios', 'id_trabajadores');
    }

    // Relación con Problemas
    public function problemas()
    {
        return $this->hasMany(Problema::class, 'id_oficios', 'id_oficios');
    }
}
