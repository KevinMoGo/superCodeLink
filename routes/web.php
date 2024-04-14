<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\AmistadesController;
use App\Http\Controllers\FotosController;
Route::get('/', function () {
    return view('login');
});

Route::get('/registro', function () {
    return view('registro');
});


Route::get('registroSubir', function () {
    return view('registroSubir');
});
Route::get('buscados', function () {
    return view('buscados');
});




Route::post('creaUsuario', [UsuariosController::class, 'creaUsuario']);
Route::post('login', [UsuariosController::class, 'login']);
Route::post('buscador', [UsuariosController::class, 'buscador']);

Route::post('agregar-solicitud/{id}', [SolicitudController::class, 'agregarSolicitud']);
Route::get('notis', [SolicitudController::class, 'MostrarSolicitudes']);
Route::post('aceptar-solicitud/{id}', [AmistadesController::class, 'aceptarSolicitud']);
Route::post('rechazar-solicitud/{id}', [AmistadesController::class, 'rechazarSolicitud']);
Route::get('amigos', [AmistadesController::class, 'MostrarAmigos']);

Route::post('subir', [FotosController::class, 'subirFoto']);

Route::post('eliminarFoto/{id_foto}', [FotosController::class, 'eliminarFoto']);
Route::get('misimagenes', [UsuariosController::class, 'mostrarMisImagenes'])->name('misimagenes');
Route::get('inicio', [UsuariosController::class, 'mostrarInicio'])->name('inicio');