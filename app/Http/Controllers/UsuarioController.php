<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function crear(Request $request)
    {
        $request->validate([
            'correo' => 'required|email|unique:usuarios,correo',
            'nombres' => 'required',
            'apellidos' => 'required',
        ]);

        $usuario = Usuario::create($request->all());

        return response()->json([
            'message' => 'Usuario creado',
            'usuario' => $usuario
        ], 201);
    }

    public function modificar(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'correo' => 'email|unique:usuarios,correo,' . $usuario->id,
            'nombres' => 'required',
            'apellidos' => 'required',
        ]);

        $usuario->update($request->all());

        return response()->json([
            'message' => 'Usuario actualizado',
            'usuario' => $usuario
        ], 200);
    }

    public function eliminar($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return response()->json([
            'message' => 'Usuario eliminado',
            'usuario' => $usuario
        ], 200);
    }

    public function consultar($id)
    {
        $usuario = Usuario::with('ingresos')->findOrFail($id);

        return response()->json([
            'message' => 'Usuario consultado',
            'usuario' => $usuario
        ], 200);
    }

    public function todos()
    {
        $usuarios = Usuario::with('ingresos')->get();

        $response = $usuarios->map(function ($usuario) {
            return [
                'usuario' => [
                    'id' => $usuario->id,
                    'correo' => $usuario->correo,
                    'nombres' => $usuario->nombres,
                    'apellidos' => $usuario->apellidos,
                    'created_at' => $usuario->created_at,
                    'updated_at' => $usuario->updated_at,
                ],
                'ingresos' => $usuario->ingresos->map(function ($ingreso) {
                    return [
                        'id' => $ingreso->id,
                        'fecha_entrada' => $ingreso->fecha_entrada,
                        'fecha_salida' => $ingreso->fecha_salida,
                        'created_at' => $ingreso->created_at,
                        'updated_at' => $ingreso->updated_at,
                    ];
                }),
            ];
        });

        return response()->json([
            'message' => 'Todos los usuarios con sus ingresos',
            'data' => $response
        ], 200);
    }
}
