<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problema extends Model
{
    use HasFactory;

    protected $table = 'problemas';
    protected $primaryKey = 'id_problemas';
    public $timestamps = true;

    protected $fillable = [
        'id_cliente',
        'id_oficios',
        'descripcion',
        'monto',
        'fecha',
        'id_estado_problema',
    ];

    // Relación con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    // Relación con Oficio
    public function oficio()
    {
        return $this->belongsTo(Oficios::class, 'id_oficios', 'id_oficios');
    }

    // Relación con EstadoProblema
    public function estadoProblema()
    {
        return $this->belongsTo(EstadoProblema::class, 'id_estado_problema', 'id_estado_problema');
    }
}
