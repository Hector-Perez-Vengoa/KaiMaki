<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoUsers extends Model
{
    use HasFactory;

    protected $table = 'estado_users'; // Nombre de la tabla
    protected $primaryKey = 'id_estado_users'; // Clave primaria personalizada
    protected $fillable = [
        'nombre_estado',
        'id_estado_users',
    ];
    // Relación con Certificados (uno a muchos)
    public function users ()
    {
        return $this->hasMany(Certificados::class, 'id_estado_users', 'id_estado_users');
    }
}
