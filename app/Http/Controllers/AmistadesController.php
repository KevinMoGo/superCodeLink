<?php

namespace App\Http\Controllers;

use App\Models\Solicitudes;
use App\Models\Usuarios;
use App\Models\Amistades;
use Illuminate\Http\Request;
use App\Http\Controllers\TokenController;

class AmistadesController extends Controller
{
    // Creamos una instancia de TokenController para poder usar sus métodos
    private $tokenController;
    public function __construct()
    {
        $this->tokenController = new TokenController();
    }

    public function enviar_solicitud(Request $request)
    {
        // Extraemos la información de todo el json
        $datos = $request->json()->all();
        // Extraemos el id del usuario receptor
        $id = $datos['id_receptor'];
        $sessionID = session('user_id');
        // Busamos si existe el usuario receptor
        $usuario = Usuarios::where('id', $id)->first();
        if (!$usuario) {
            return response()->json(['error' => 'El usuario no existe']);
        }
        // Verificamos si ya existe una solicitud comprobando si sessionID es el usuario emisor y id es el usuario receptor o al reves, ya que estarian en distinto orden pero seguirian siendo la misma solicitud
        if (Solicitudes::where('usuario_emisor_id', $sessionID)->where('usuario_receptor_id', $id)->first() || Solicitudes::where('usuario_emisor_id', $id)->where('usuario_receptor_id', $sessionID)->first()) {
            return response()->json(['error' => 'Ya existe una solicitud']);
        }
        else{
            // Creamos la solicitud
            $solicitud = new Solicitudes();
            $solicitud->usuario_emisor_id = $sessionID;
            $solicitud->usuario_receptor_id = $id;
            $solicitud->save();
            return response()->json(['success' => 'Solicitud enviada']);
        }

        
        
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
}
