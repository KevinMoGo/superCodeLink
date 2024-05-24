<?php

namespace App\Http\Controllers;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    // Crea una funcion booleana que comprueba si hay un token en la cookie llamado tokenUsuarioCodeLink, si lo hay devuelve true, si no, false
    public static function comprobarToken(){
        // Extraemos la variable de sesión username
        $username = session('username');
        // La buscamos en la base de datos
        $usuario = Usuarios::where('username', $username)->first();
        // Extraemos el id y el salt del usuario
        $id = $usuario->id;
        $salt = $usuario->salt;

        // Comprobamos si el token de la cookie es igual al token generado con el id y el salt
        if (isset($_COOKIE['tokenUsuarioCodeLink']) && $_COOKIE['tokenUsuarioCodeLink'] == hash('sha256', $id.$salt)) {
            return true;
        }
        else{
            return false;
        }

    }
    

}
