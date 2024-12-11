<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes'; // Nombre de la tabla
    protected $primaryKey = 'id_cliente'; // Nombre de la clave primaria
    public $timestamps = true; // Si usas columnas created_at y updated_at

    protected $fillable = [
        'id_usuario',
        'id_ubicacion',
        'nom_cliente',
        'ape_cliente',
        'telefo_cliente',
        'dni',
        'sexo',
    ];

    // Relación con Ubicación
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion', 'id_ubicacion');
    }

    // Relación con Usuario
    public function users()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    // Relación con Problemas
    public function problemas()
    {
        return $this->hasMany(Problema::class, 'id_cliente', 'id_cliente');
    }

    // Relación uno a muchos con Solicitudes
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'id_cliente', 'id_cliente');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }


}
