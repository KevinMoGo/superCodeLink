<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Usuarios;

class ChatController extends Controller
{
    

    // function enviarMensaje(id) {
    //     // Route::post('/enviarMensaje', [ChatController::class, 'enviarMensaje']);
    //     var mensaje = document.querySelector('input').value;
    //     // Hacemos un fetch a la ruta /enviarMensaje pasandole el id del usuario y el mensaje y nuestro id de la variable de sesion user_id
    //     fetch('/enviarMensaje', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //         },
    //         body: JSON.stringify({
    //             id: id,
    //             mensaje: mensaje,
    //             user_id: {{ session('user_id') }}
    //         })
    //     })
    //     // Con then hacemos un console.log de la respuesta
    //     .then(response => response.json())
    //     .then(data => console.log(data));

    // }

    function enviarMensaje(Request $request) {
        try {
            // Convertimos los valores del request a string para evitar inyecciones de SQL
            $id = (string)$request->id;
            $mensaje = (string)$request->mensaje;
            $user_id = (string)$request->user_id;
    
            // Creamos una nueva instancia del modelo Chat
            $chat = new Chat();
            $chat->usuario1_id = $user_id;
            $chat->usuario2_id = $id;
            $chat->mensaje = $mensaje;
            $chat->fecha_envio = date('Y-m-d H:i:s');
    
            // Intentamos guardar el mensaje en la base de datos
            if ($chat->save()) {
                // Si se guarda correctamente, devolvemos un JSON con el mensaje de éxito
                return response()->json(['mensaje' => 'Mensaje enviado'], 200);
            } else {
                // Si ocurre algún problema al guardar, devolvemos un JSON con un mensaje de error
                return response()->json(['mensaje' => 'Error al enviar el mensaje'], 500);
            }
        } catch (\Exception $e) {
            // Si ocurre una excepción, capturamos el mensaje de la excepción y devolvemos un JSON con el mensaje de error
            return response()->json(['mensaje' => 'Ocurrió un error: ' . $e->getMessage()], 500);
        }
    }


    public function getMensajes(Request $request) {
        try {
            // Recibimos el json y mandamos un response con los datos para debbugear
            // Primero extraemos el id
            $id = $request->id;
            // Luego el user_id
            $user_id = $request->user_id;
            // Buscar los mensajes en la base de datos donde id sea usuario1_id o usuario2_id y user_id sea usuario1_id o usuario2_id y guardamos en una variable ordenado por fecha de envio
            $mensajes = Chat::where(function ($query) use ($id, $user_id) {
                $query->where('usuario1_id', $id)->where('usuario2_id', $user_id);
            })->orWhere(function ($query) use ($id, $user_id) {
                $query->where('usuario1_id', $user_id)->where('usuario2_id', $id);
            })->orderBy('fecha_envio', 'asc')->get();

            // Devolvemos un JSON con los mensajes
            return response()->json($mensajes, 200);
            
        } catch (\Exception $e) {
            // Si ocurre una excepción, capturamos el mensaje de la excepción y devolvemos un JSON con el mensaje de error
            return response()->json(['mensaje' => 'Ocurrió un error: ' . $e->getMessage()], 500);
        }
    }
    





}
