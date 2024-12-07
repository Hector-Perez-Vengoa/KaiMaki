<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Reclamos extends Model
{

    use HasFactory;
    // Nombre de la tabla
    protected $table = 'reclamos';

    // Clave primaria personalizada
    protected $primaryKey = 'id_reclamo';

    // Campos asignables
    protected $fillable = [
        'asunto',
        'descripcion',
        'id_administrador',
        'fech_reclamo',
        'id_usuario',
        'id_estado_reclamo',
    ];

    public function estado()
    {
        return $this->belongsTo(EstadoReclamos::class, 'id_estado_reclamo', 'id_estado_reclamo');
    }
    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'id_administrador', 'id_aministrador');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

}
