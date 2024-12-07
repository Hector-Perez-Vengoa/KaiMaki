<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negociacion extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'negociacion';

    // Clave primaria personalizada
    protected $primaryKey = 'id_negociacion';

    // Campos asignables
    protected $fillable = [
        'id_solicitudes',
        'monto',
        'nueva_fech_reserva',
        'hora_inicio',
        'tiempo_estimado',
        'mensaje',
    ];

    // Relaciones
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'id_solicitudes', 'id_solicitudes');
    }
}
