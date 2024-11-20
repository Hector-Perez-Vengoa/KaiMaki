<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Antecedentes extends Model
{   
    use HasFactory;

    protected $table = 'antecedentes'; // Nombre de la tabla
    protected $fillable = [

        'documento_antecedente',
        'id_trabajadores',
        'id_estado_antecedentes',
    ];
    public function trabajador()
    {
        return $this->belongsTo(Trabajadores::class, 'id_trabajadores');
    }
    
    public function EstadoAntecedentes()
    {
        return $this->belongsTo(EstadoAntecedentes::class, 'id_estado_antecedentes', 'id_estado_antecedentes');
    }
}
