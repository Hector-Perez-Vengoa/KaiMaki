<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $table = 'mensajes';

    protected $fillable = [
        'id_negociacion',
        'id_usuario',
        'contenido',
        'tipo',
        'archivo_url',
    ];

    // Relación con la negociación
    public function negociacion()
    {
        return $this->belongsTo(Negociacion::class, 'id_negociacion');
    }

    // Relación con el usuario
    public function users()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
