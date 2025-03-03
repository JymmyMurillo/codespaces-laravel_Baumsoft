<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingreso;

class IngresoController extends Controller
{
    public function crear(Request $request, $usuario_id)
    {
        $usuario = Usuario::findOrFail($usuario_id);

        $ingreso = Ingreso::create([
            'usuario_id' => $usuario_id,
            'fecha_entrada' => now(),
            'fecha_salida' => now()->addHours(5),
        ]);

        return response()->json([
            'message' => 'Ingreso creado',
            'ingreso' => $ingreso,
            'usuario' => $usuario
        ], 201);
    }
}
