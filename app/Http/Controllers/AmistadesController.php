<?php

namespace App\Http\Controllers;

use App\Models\Solicitudes;
use App\Models\Usuarios;
use App\Models\Amistades;
use Illuminate\Http\Request;

class AmistadesController extends Controller
{


    public function nuevaSolicitud(Request $request){
        $miID = session('user_id');
        $id = $request->id;
        $solicitud = Solicitudes::where('usuario_emisor_id', $miID)
                      ->where('usuario_receptor_id', $id)
                      ->orWhere(function ($query) use ($miID, $id) {
                          $query->where('usuario_emisor_id', $id)
                                ->where('usuario_receptor_id', $miID);
                      })->first();
        if (!$solicitud) {
            $nuevaSolicitud = new Solicitudes();
            $nuevaSolicitud->usuario_emisor_id = $miID;
            $nuevaSolicitud->usuario_receptor_id = $id;
            $nuevaSolicitud->save();
            
            return response()->json(['success' => 'Solicitud enviada con éxito.']);
        }
    
        return response()->json(['error' => 'Ya existe una solicitud entre estos usuarios.']);
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
