<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\AmistadesController;
use App\Http\Controllers\FotosController;
use App\Http\Controllers\ChatController;

use App\Http\Middleware\VerificarTokenUsuario;




Route::middleware(['verificarTokenUsuario'])->get('registroSubir', function () {
    return view('registroSubir');
});

Route::get('buscados', function () {
    return view('buscados');
});

Route::get('/datosBarra', [UsuariosController::class, 'datosBarra']);
Route::get('/datosEditar', [UsuariosController::class, 'datosEditar']);
Route::put('/editarPerfil1', [UsuariosController::class, 'editarPerfil1']);
Route::put('/editarPerfil2', [UsuariosController::class, 'editarPerfil2']);
Route::get('/logout', [UsuariosController::class, 'logout']);

Route::post('/subirFotoPerfil', [FotosController::class, 'subirFotoPerfil']);

// Ruta para guardar nuevo perfil
Route::post('/guardarPerfil', [UsuariosController::class, 'guardarPerfil']);
Route::get('/getDatosPerfil', [UsuariosController::class, 'getDatosPerfil']);



// LOGIN  -------------------------------------------------------------------------------------------------------
Route::get('/', function () {
    return view('login');
});
Route::post('/login', [UsuariosController::class, 'login']);


// REGISTRO  ----------------------------------------------------------------------------------------------------
Route::get('/registro', function () {
    return view('registro');
});
Route::get('/validarUsername/{username}', [UsuariosController::class, 'validarUsername']);
Route::post('/registro', [UsuariosController::class, 'registro']);


// INICIO  ----------------------------------------------------------------------------------------------------
Route::middleware(['verificarTokenUsuario'])->post('/buscar', [UsuariosController::class, 'buscar']);
Route::get('/buscar', [UsuariosController::class, 'error404']);

Route::middleware(['verificarTokenUsuario'])->group(function () {
    Route::get('/inicio', [UsuariosController::class, 'mostrarInicio']);
});

Route::middleware(['verificarTokenUsuario'])->get('/perfilUsuario/{id}', [UsuariosController::class, 'perfilUsuario']);



// BUSCADOS  ---------------------------------------------------------------------------------------------------


Route::post('/nuevaSolicitud', [AmistadesController::class, 'nuevaSolicitud']);

// IMAGENES  ---------------------------------------------------------------------------------------------------

Route::post('/subirImagen', [FotosController::class, 'subirImagen']);

// MIS IMAGENES  -----------------------------------------------------------------------------------------------

Route::delete('/deletepost', [FotosController::class, 'deletepost']);

Route::get('/getpost/{id_foto}', [FotosController::class, 'getpost']);
// Ruta para actualizar la foto de perfil
Route::put('/editpost', [FotosController::class, 'editpost']);


// NOTIFICACIONES  ---------------------------------------------------------------------------------------------

Route::get('/api_amigos', [AmistadesController::class, 'api_amigos']);

// AMIGOS  -----------------------------------------------------------------------------------------------------

Route::middleware(['verificarTokenUsuario'])->get('amigos', [AmistadesController::class, 'MostrarAmigos']);
Route::get('/chatAmigo/{id}', [AmistadesController::class, 'chatAmigo']);

// CHAT  -------------------------------------------------------------------------------------------------------
Route::post('/enviarMensaje', [ChatController::class, 'enviarMensaje']);
Route::post('/getMensajes', [ChatController::class, 'getMensajes']);













Route::post('agregar-solicitud/{id}', [SolicitudController::class, 'agregarSolicitud']);
Route::middleware(['verificarTokenUsuario'])->get('notis', [SolicitudController::class, 'MostrarSolicitudes']);
Route::post('aceptar-solicitud/{id}', [AmistadesController::class, 'aceptarSolicitud']);
Route::post('rechazar-solicitud/{id}', [AmistadesController::class, 'rechazarSolicitud']);


Route::post('subir', [FotosController::class, 'subirFoto']);
Route::post('subirPerfil', [FotosController::class, 'subirFotoPerfil']);

Route::middleware(['verificarTokenUsuario'])->get('misimagenes', [UsuariosController::class, 'mostrarMisImagenes'])->name('misimagenes');




Route::delete('/delete_amigo/{id}', [AmistadesController::class, 'delete_amigo']);

Route::post('editar_foto', [FotosController::class, 'editar_foto']);

Route::get('coger_datos/{id}', [FotosController::class, 'coger_datos']);
Route::get('apiAmigos/{id}', [AmistadesController::class, 'apiAmigos']);


