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
        'id_problema',
        'fech_reserva',
        'descripcion',
        'hora_inicio_propuesta',
    ];

    // Relaciones
    public function estado()
    {
        return $this->belongsTo(EstadoSolicitud::class, 'id_estado_solicitudes', 'id_estado_solicitudes');
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajadores::class, 'id_trabajadores', 'id_trabajadores');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenSolicitud::class, 'id_solicitudes', 'id_solicitudes');
    }

    public function negociaciones()
    {
        return $this->hasOne(Negociacion::class, 'id_solicitudes', 'id_solicitudes');
    }

    public function problemas()
    {
        return $this->belongsTo(Problema::class, 'id_problema', 'id_problemas');
    }

}
