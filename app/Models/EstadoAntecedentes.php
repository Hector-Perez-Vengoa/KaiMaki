<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoAntecedentes extends Model
{
    use HasFactory;

    protected $table = 'estado_antecedentes'; // Nombre de la tabla
    protected $primaryKey = 'id_estado_antecedentes'; // Clave primaria personalizada
    protected $fillable = [

        'nombre_estado',
        'id_estado_antecedentes',
    ];
    // Relación con Certificados (uno a muchos)
    public function antecedentes()
    {
        return $this->hasMany(Antecedentes::class, 'id_estado_antecedentes', 'id_estado_antecedentes');
    }
}

