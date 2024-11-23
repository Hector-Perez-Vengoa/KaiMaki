<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'solicitudes';

    // Clave primaria personalizada
    protected $primaryKey = 'id_solicitudes';

    // Campos asignables
    protected $fillable = [
        'id_estado_solicitudes',
        'id_trabajadores',
        'id_cliente',
        'fech_reserva',
        'descripcion',
    ];

    // Relaciones

    public function estado()
    {
        return $this->belongsTo(EstadoSolicitud::class, 'id_estado_solicitudes', 'id_estado_solicitudes');
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class, 'id_trabajadores', 'id_trabajadores');
    }

    // Relación muchos a uno con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}