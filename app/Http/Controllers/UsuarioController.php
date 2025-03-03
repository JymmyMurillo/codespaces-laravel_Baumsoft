<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class UsuarioController extends Controller
{
    public function crear(Request $request)
    {
        try {
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
        } catch (QueryException $e) {
             return response()->json([
                'message' => 'Error al crear el usuario',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function modificar(Request $request, $id)
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al modificar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }


    }

    public function eliminar($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();

            return response()->json([
                'message' => 'Usuario eliminado',
                'usuario' => $usuario
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function consultar($id)
    {
        try {
            $usuario = Usuario::with('ingresos')->findOrFail($id);

            return response()->json([
                'message' => 'Usuario consultado',
                'usuario' => $usuario
            ], 200);
        } catch (\Exception $e) {
             return response()->json([
                'message' => 'Usuario no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }

    }

    public function todos()
    {
        try {
            $usuarios = Usuario::with('ingresos')->get();

            $response = $usuarios->map(function ($usuario) {
                return [

                        'id' => $usuario->id,
                        'correo' => $usuario->correo,
                        'nombres' => $usuario->nombres,
                        'apellidos' => $usuario->apellidos,
                        'created_at' => $usuario->created_at,
                        'updated_at' => $usuario->updated_at,
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
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al consultar los usuarios',
                'error' => $e->getMessage()
            ], 500);
        }

    }
}
