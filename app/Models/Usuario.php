<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = ['correo', 'nombres', 'apellidos'];

    public function ingresos()
    {
        return $this->hasMany(Ingreso::class);
    }
}
