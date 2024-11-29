<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Antecedentes extends Model
{
    use HasFactory;

    protected $table = 'antecedentes'; // Nombre de la tabla
    protected $primaryKey = 'id_antecedentes'; // Clave primaria personalizada
    protected $fillable = [

        'documento_antecedente',
        'id_trabajadores',
        'id_estado_antecedentes',
    ];
    public function trabajadores()
    {
        return $this->belongsTo(Trabajadores::class, 'id_trabajadores');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoAntecedentes::class, 'id_estado_antecedentes', 'id_estado_antecedentes');
    }
}
