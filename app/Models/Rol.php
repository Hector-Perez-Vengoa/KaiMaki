<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    //protected $primaryKey = 'id_roles';
    protected $fillable = ['nombre'];
    public function users(){
        //define la relaciones 
        return $this->hasMany('App\Models\User', 'id_roles', 'id');
    }
}
