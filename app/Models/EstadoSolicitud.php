<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoSolicitud extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'estado_solicitudes';

    // Clave primaria personalizada
    protected $primaryKey = 'id_estado_solicitudes';

    // Campos asignables
    protected $fillable = [
        'nombre_estado',
    ];

    // Relaciones

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'id_estado_solicitudes', 'id_estado_solicitudes');
    }
}
