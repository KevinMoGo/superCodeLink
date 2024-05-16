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
        // Verificamos el token del usuario
        if ($this->tokenController->compruebaToken()) {
            $amigos = Amistades::where('usuario1_id', session('user_id'))
        ->orWhere('usuario2_id', session('user_id'))
        ->get();

        // Inicializamos una variable para almacenar los IDs de los amigos
        $ids_amigos = [];

        // Iteramos sobre las amistades para obtener los IDs de los amigos
        foreach ($amigos as $amigo) {
        // Verificamos si el usuario logueado es usuario1_id o usuario2_id
        if ($amigo->usuario1_id == session('user_id')) {
        $ids_amigos[] = $amigo->usuario2_id;
        } else {
        $ids_amigos[] = $amigo->usuario1_id;
        }
        }

        // Convertimos los IDs de amigos en una colección y eliminamos duplicados
        $ids_amigos = collect($ids_amigos)->unique();

        //Ahora extraemos los datos de los amigos
        $amigos = Usuarios::whereIn('id', $ids_amigos)->get();

        return view('amigos', ['amigos' => $amigos]);
        }
        return redirect('/');
        
    }

    public function apiAmigos($id)
    {
        $amigos = Amistades::where('usuario1_id', $id)
        ->orWhere('usuario2_id', $id)
        ->get();

        // Inicializamos una variable para almacenar los IDs de los amigos
        $ids_amigos = [];

        // Iteramos sobre las amistades para obtener los IDs de los amigos
        foreach ($amigos as $amigo) {
        // Verificamos si el usuario logueado es usuario1_id o usuario2_id
        if ($amigo->usuario1_id == $id) {
        $ids_amigos[] = $amigo->usuario2_id;
        } else {
        $ids_amigos[] = $amigo->usuario1_id;
        }
        }

        // Convertimos los IDs de amigos en una colección y eliminamos duplicados
        $ids_amigos = collect($ids_amigos)->unique();

        //Ahora extraemos los datos de los amigos
        $amigos = Usuarios::whereIn('id', $ids_amigos)->get();

        return response()->json($amigos);
    }

    public function delete_amigo($id)
    {
        // Eliminamos la amistad
        Amistades::where('usuario1_id', $id)->where('usuario2_id', session('user_id'))->delete();
        Amistades::where('usuario2_id', $id)->where('usuario1_id', session('user_id'))->delete();

        return response()->json(['success' => true]);
    }
}
