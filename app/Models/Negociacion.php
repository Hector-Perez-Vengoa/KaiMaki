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
        'id_cliente',
        'id_trabajadores',
        'monto',
        'nueva_fech_reserva',
        'hora_inicio',
        'tiempo_estimado',
        'mensaje',
        'estado_negociacion',
        'ubicacion_nueva',
        'cambio_fecha',
        'cambio_ubicacion',
    ];
    // Relaciones
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'id_solicitudes', 'id_solicitudes');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajadores::class, 'id_trabajadores', 'id_trabajadores');
    }

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class, 'id_negociacion');
    }
}
