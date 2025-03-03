<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
