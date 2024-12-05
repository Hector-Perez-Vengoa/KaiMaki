<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Administrador extends Model
{
    use HasFactory;
    // Nombre de la tabla
    protected $table = 'administrador';

    // Clave primaria personalizada
    protected $primaryKey = 'id_administrador';

    // Campos asignables
    protected $fillable = [
        'dni',
        'nombres',
        'apellido',
        'telefono',
        'id_usuario',
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function reclamo()
    {
        return $this->hasMany(Reclamos::class, 'id_reclamo', 'id_reclamo');
    }
}
