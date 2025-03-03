<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingreso;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class IngresoController extends Controller
{
    public function crear(Request $request, $usuario_id)
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el ingreso',
                'error' => $e->getMessage()
            ], 500);
        }

    }
}
