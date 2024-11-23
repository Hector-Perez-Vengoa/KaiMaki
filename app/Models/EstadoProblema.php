<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoProblema extends Model
{
    use HasFactory;

    protected $table = 'estado_problema'; // Nombre de la tabla
    protected $primaryKey = 'id_estado_problema'; // Clave primaria
    public $timestamps = true; // Habilitamos timestamps si es necesario

    // Relación con Problemas
    public function problemas()
    {
        return $this->hasMany(Problema::class, 'id_estado_problema', 'id_estado_problema');
    }
}
