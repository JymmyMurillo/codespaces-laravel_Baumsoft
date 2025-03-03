<?php

use Illuminate\Support\Facades\Route;

Route::get('/usuarios/crear', [UsuarioController::class, 'crear']);

Route::get('/usuarios/modificar/{id}', [UsuarioController::class, 'modificar']);

Route::get('/usuarios/eliminar/{id}', [UsuarioController::class, 'eliminar']);
