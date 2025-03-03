<?php

use Illuminate\Support\Facades\Route;

Route::get('/usuarios/crear', [UsuarioController::class, 'crear']);

Route::get('/usuarios/modificar/{id}', [UsuarioController::class, 'modificar']);

Route::get('/usuarios/eliminar/{id}', [UsuarioController::class, 'eliminar']);

Route::get('/usuarios/consultar/{id}', [UsuarioController::class, 'consultar']);


Route::get('/ingresos/crear/{usuario_id}', [IngresoController::class, 'crear']);
