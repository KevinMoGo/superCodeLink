<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\AmistadesController;
use App\Http\Controllers\FotosController;



Route::get('registroSubir', function () {
    return view('registroSubir');
});

Route::get('buscados', function () {
    return view('buscados');
});

Route::get('/datosBarra', [UsuariosController::class, 'datosBarra']);
Route::post('/subirFotoPerfil', [FotosController::class, 'subirFotoPerfil']);

// Ruta para guardar nuevo perfil
Route::post('/guardarPerfil', [UsuariosController::class, 'guardarPerfil']);
Route::get('/getDatosPerfil', [UsuariosController::class, 'getDatosPerfil']);



// LOGIN  -------------------------------------------------------------------------------------------------------
Route::get('/', function () {
    return view('login');
});

Route::post('/login', [UsuariosController::class, 'login']);

Route::get('/registro', function () {
    return view('registro');
});

Route::get('/inicio', [UsuariosController::class, 'mostrarInicio']);


// REGISTRO  ----------------------------------------------------------------------------------------------------
Route::get('/registro', function () {
    return view('registro');
});

Route::post('/registroUsername', [UsuariosController::class, 'registroUsername']);

Route::get('/cancelarRegistro', [UsuariosController::class, 'cancelarRegistro']);

Route::post('/registroDatos', [UsuariosController::class, 'registroDatos']);


// INICIO  ----------------------------------------------------------------------------------------------------

Route::post('/buscar', [UsuariosController::class, 'buscar']);

// BUSCADOS  ---------------------------------------------------------------------------------------------------

Route::post('/enviar_solicitud', [AmistadesController::class, 'enviar_solicitud']);

// IMAGENES  ---------------------------------------------------------------------------------------------------

Route::post('/subirImagen', [FotosController::class, 'subirImagen']);

// MIS IMAGENES  -----------------------------------------------------------------------------------------------

Route::delete('/deletepost', [FotosController::class, 'deletepost']);
Route::post('/getpost', [FotosController::class, 'getpost']);
// Ruta para actualizar la foto de perfil
Route::put('/editpost', [FotosController::class, 'editpost']);


// NOTIFICACIONES  ---------------------------------------------------------------------------------------------

Route::get('/api_amigos', [AmistadesController::class, 'api_amigos']);

// AMIGOS  -----------------------------------------------------------------------------------------------------

Route::get('amigos', [AmistadesController::class, 'MostrarAmigos']);
Route::get('/chatAmigo/{id}', [AmistadesController::class, 'chatAmigo']);














Route::post('agregar-solicitud/{id}', [SolicitudController::class, 'agregarSolicitud']);
Route::get('notis', [SolicitudController::class, 'MostrarSolicitudes']);
Route::post('aceptar-solicitud/{id}', [AmistadesController::class, 'aceptarSolicitud']);
Route::post('rechazar-solicitud/{id}', [AmistadesController::class, 'rechazarSolicitud']);


Route::post('subir', [FotosController::class, 'subirFoto']);
Route::post('subirPerfil', [FotosController::class, 'subirFotoPerfil']);

Route::get('misimagenes', [UsuariosController::class, 'mostrarMisImagenes'])->name('misimagenes');




Route::delete('/delete_amigo/{id}', [AmistadesController::class, 'delete_amigo']);

Route::post('editar_foto', [FotosController::class, 'editar_foto']);

Route::get('coger_datos/{id}', [FotosController::class, 'coger_datos']);
Route::get('apiAmigos/{id}', [AmistadesController::class, 'apiAmigos']);


