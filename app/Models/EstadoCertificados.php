<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCertificados extends Model
{
    use HasFactory;

    protected $table = 'estado_certificados'; // Nombre de la tabla
    protected $primaryKey = 'id_estado_certificados'; // Clave primaria personalizada

    // Relación con Certificados (uno a muchos)
    public function certificados()
    {
        return $this->hasMany(Certificados::class, 'id_estado_certificados', 'id_estado_certificados');
    }
}

