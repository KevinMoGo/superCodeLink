<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Models\Solicitudes;
use App\Models\Amistades;
use Illuminate\Http\Request;
use App\Models\Fotos;

class UsuariosController extends Controller
{

    public function index()
    {
        //
    }
    public function creaUsuario()
    {
        $usuario = new Usuarios();
        $usuario->nombre = request('nombre');
        $usuario->username = request('usuario');
        $usuario->contrasena = request('contrasena');
        $usuario->save();
        return redirect('/');
    }

    public function login()
    {
        $usuario = Usuarios::where('username', request('nombre'))->where('contrasena', request('contrasena'))->first();
        if($usuario){
            session(['user_id' => $usuario->id]);
            return redirect('inicio');
        }else{
            return redirect('/');
        }
    }

    public function mostrarMisImagenes()
    {
        //cargamos todas las fotos del usuario logueado
        $fotos = Fotos::where('id_usuario', session('user_id'))->get();
        return view('misimagenes', ['fotos' => $fotos]);
    }

    public function mostrarInicio(){
        // Nos vamos a inicio.blade.php sin más
        return view('inicio');
    }

    public function buscador()
    {
        
        //$usuarios = Usuarios::where('nombre', 'like', '%'.request('buscador').'%')->get();
        //Extrae a los usuarios a excepción del usuario logueado
        $usuarios = Usuarios::where('nombre', 'like', '%'.request('buscador').'%')->where('id', '!=', session('user_id'))->get();
        //Extrae las id de los usuarios que ha encontrado el buscador
        $ids = $usuarios->pluck('id');
        //Busca en la tabla solicitudes si el usuario ya ha enviado una solicitud a los usuarios encontrados
        $solicitudes = Solicitudes::where('usuario_emisor_id', session('user_id'))->whereIn('usuario_receptor_id', $ids)->get();
        //Busca en la tabla amistades si el usuario ya es amigo de los usuarios encontrados
        $amigos = Amistades::where('usuario1_id', session('user_id'))->orWhere('usuario2_id', session('user_id'))->get();
        return view('buscados', ['usuarios' => $usuarios, 'solicitudes' => $solicitudes, 'amigos' => $amigos]);
    }


}
