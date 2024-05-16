<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function creaToken($usuario)
    {
        // Generar un token único utilizando el ID del usuario y un secreto
        $secreto = 'HabiaUnaVezUnBarquitoChiquitito';
        $idUsuario = $usuario->id;
        $token = hash('sha256', $idUsuario . $secreto);
        $usuario->token = $token;
        $usuario->save();
        
        
    }

    public function configurarToken($token)
    {
        // Guardar el token en la session
        session(['tokenUsuarioCodeLink' => $token]);
        // Guardar el token en una cookie
        setcookie('tokenUsuarioCodeLink', $token, time() + 3600, '/');
    }


    public function eliminaToken()
    {
        // Eliminamos el token de la session
        session()->forget('tokenUsuarioCodeLink');
        // Eliminamos el token de la cookie
        setcookie('tokenUsuarioCodeLink', '', time() - 3600, '/');
    }

    public function compruebaToken()
    {
        $validacion = false;
        // Comprobamos si en las cookies hay un token llamado tokenUsuarioCodeLink
        if (isset($_COOKIE['tokenUsuarioCodeLink'])) {
            // Comprobamos si el token de la cookie es igual al token de la session
            if ($_COOKIE['tokenUsuarioCodeLink'] == session('tokenUsuarioCodeLink')) {
                $validacion = true;
            }
        }
        return $validacion;
        
    }

    public function prueba()
{
    // Extraer el token de la sesión
    $token = session('tokenUsuarioCodeLink');

    // Descomponer el token para obtener el ID del usuario
    $secreto = 'HabiaUnaVezUnBarquitoChiquitito';
    $idUsuario = substr($token, 0, strlen($token) - strlen($secreto));

    dd($idUsuario);
}
    

}
