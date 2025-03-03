<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $fillable = ['usuario_id', 'fecha_entrada', 'fecha_salida'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
