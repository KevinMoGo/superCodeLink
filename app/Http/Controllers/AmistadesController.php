<?php

namespace App\Http\Controllers;

use App\Models\Solicitudes;
use App\Models\Usuarios;
use App\Models\Amistades;
use Illuminate\Http\Request;

class AmistadesController extends Controller
{


    public function nuevaSolicitud(Request $request){
        // function enviarSolicitud(id) {
        //     // Hacemos una llamada a la API para enviar la solicitud mediante una peticion POST y ruta /nuevaSolicitud
        //     fetch('/nuevaSolicitud', {
        //         method: 'POST',
        //         headers: {
        //             'Content-Type': 'application/json',
        //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //         },
        //         body: JSON.stringify({
        //             usuario_receptor_id: id
        //         })
        //     })
        // }

        // Comprobamos si el usuario receptor ya ha enviado una solicitud al usuario emisor

    }


    public function aceptarSolicitud($id)
    {
        // Eliminamos la solicitud
        Solicitudes::where('usuario_emisor_id', $id)->where('usuario_receptor_id', session('user_id'))->delete();
        // Creamos una nueva amistad
        $amistad = new Amistades();
        $amistad->usuario1_id = $id;
        $amistad->usuario2_id = session('user_id');
        $amistad->save();

        return redirect('/notis');
    }

    public function rechazarSolicitud($id)
    {
        // Eliminamos la solicitud
        Solicitudes::where('usuario_emisor_id', $id)->where('usuario_receptor_id', session('user_id'))->delete();

        return redirect('/notis');
    }

    public function MostrarAmigos()
    {
        // buscamos en la tabla amistades los amigos del usuario ya sea como usuario1_id o usuario2_id y guardamos el id del amigo en un array
        $amigos = Amistades::where('usuario1_id', session('user_id'))->orWhere('usuario2_id', session('user_id'))->get();
        $amigosArray = [];
        foreach ($amigos as $amigo) {
            if ($amigo->usuario1_id == session('user_id')) {
                array_push($amigosArray, $amigo->usuario2_id);
            } else {
                array_push($amigosArray, $amigo->usuario1_id);
            }
        }

        // Ahora buscamos en la tabla usuarios los datos de los amigos y los guardamos en un array
        $amigosDatos = [];
        foreach ($amigosArray as $amigo) {
            $amigoDatos = Usuarios::where('id', $amigo)->first();
            array_push($amigosDatos, $amigoDatos);
        }

        return view('amigos', ['amigos' => $amigosDatos]);
        
    }


    




    public function delete_amigo($id)
    {
        // Eliminamos la amistad
        Amistades::where('usuario1_id', $id)->where('usuario2_id', session('user_id'))->delete();
        Amistades::where('usuario2_id', $id)->where('usuario1_id', session('user_id'))->delete();

        return response()->json(['success' => true]);
    }



    public function chatAmigo($id)
{
    // Buscamos al usuario
    $usuario = Usuarios::where('id', $id)->first();
    return view('chat', ['usuario' => $usuario]);
}

}
