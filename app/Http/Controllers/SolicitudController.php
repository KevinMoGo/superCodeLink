<?php

namespace App\Http\Controllers;
use App\Models\Solicitudes;
use App\Models\Usuarios;
use App\Models\Amistades;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function agregarSolicitud($id)
    {
        $solicitud = new Solicitudes();
        $solicitud->usuario_emisor_id = session('user_id');
        $solicitud->usuario_receptor_id = $id;
        $solicitud->save();
        return redirect('/inicio');
    }
    public function MostrarSolicitudes()
    {
        // Extraemos las id de los usuarios que han enviado solicitudes al usuario logueado
        $ids = Solicitudes::where('usuario_receptor_id', session('user_id'))->pluck('usuario_emisor_id');
        // Extraemos los datos de los usuarios que han enviado solicitudes al usuario logueado
        $usuarios = Usuarios::whereIn('id', $ids)->get();
        return view('notis', ['usuarios' => $usuarios]);
    }

}
