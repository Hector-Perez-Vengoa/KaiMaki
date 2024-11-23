<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

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

    // Relación con ClienteSolicitudes
    public function clienteSolicitudes()
    {
        // return $this->hasMany(ClienteSolicitud::class, 'id_cliente', 'id_cliente');
    }
}
