<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenSolicitud extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'imagenes_solicitudes';

    // Clave primaria personalizada
    protected $primaryKey = 'id_imagen';

    // Campos asignables
    protected $fillable = [
        'id_solicitudes',
        'ruta_imagen',
    ];

    // Relación con Solicitud
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'id_solicitudes', 'id_solicitudes');
    }
}
