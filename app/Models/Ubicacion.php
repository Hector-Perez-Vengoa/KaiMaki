<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Ubicacion extends Model
{
    use HasFactory;

    protected $table = 'ubicacion';
    protected $primaryKey = 'id_ubicacion';
    protected $fillable = [
        'direccion',
        'distrito',
        'ciudad',
    ];
    public function trabajadores()
    {
    return $this->hasMany(Trabajadores::class, 'id_ubicacion', 'id_ubicacion');
    }
}
