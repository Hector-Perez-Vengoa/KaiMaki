<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class EstadoReclamos extends Model
{
    use HasFactory;

    protected $table = 'estado_reclamos'; // Nombre de la tabla
    protected $primaryKey = 'id_estado_reclamo'; // Clave primaria personalizada
    protected $fillable = [
        'id_estado_reclamo',
        'nombre_estado',

    ];

    public function reclamo()
    {
        return $this->hasMany(Reclamos::class, 'id_estado_reclamo', 'id_estado_reclamo');
    }
}
