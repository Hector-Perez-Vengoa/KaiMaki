<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Certificados extends Model
{
    use HasFactory;

    protected $table = 'certificados'; // Nombre de la tabla
    // Campos que pueden asignarse masivamente
    protected $fillable = [
        'documento_certificado',
        'id_trabajadores',
        'id_estado_certificados',
    ];
    
    public function trabajadores()
    {
        return $this->belongsTo(Trabajadores::class,'id_trabajadores');
    }
    public function estado()
    {
    return $this->belongsTo(EstadoCertificados::class, 'id_estado_certificados', 'id_estado_certificados');
    }
}
    
