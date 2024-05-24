<?php

namespace App\Http\Controllers;
use App\Models\Usuarios;
use App\Models\Solicitudes;
use App\Models\Amistades;
use Illuminate\Http\Request;
use App\Models\Fotos;

use App\Http\Controllers\TokenController;


class UsuariosController extends Controller
{
    private $tokenController;

    public function __construct()
    {
        $this->tokenController = new TokenController();
    }




    public function registroUsername(Request $request)
    {
    $username = $request->json()->get('username');
    $username = (string)$username;

    // Buscamos el usuario en la base de datos
    $usuario = Usuarios::where('username', $username)->first();
    if ($usuario) {
        return response()->json(['error' => 'El usuario ya existe']);
    }
    else{
        // Guardamos el nombre en una variable de sesión
        session(['username' => $username]);
        $nuevoUsuario = new Usuarios();
        $nuevoUsuario->username = $username;
        $nuevoUsuario->save();
        return response()->json(['success' => 'Usuario creado']);
    }
    }
    
    public function cancelarRegistro()
    {
        try {
            Usuarios::where('username', session('username'))->delete();
            session()->forget('username');
            return response()->json(['success' => 'Usuario eliminado']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el usuario']);
        }
    }

    public function registroDatos(Request $request){
        // Extraemos los datos del json
        try {
            $datos = $request->json()->all();
            
            // Extraemos los datos por separado retranformandolos a string para evitar inyecciones de código
            $nombre = (string)$datos['nombre'];
            $contrasena = (string)$datos['contrasena'];
            $edad = (string)$datos['edad'];
            $sexo = (string)$datos['sexo'];
            $pais = (string)$datos['pais'];

            $salt = bin2hex(random_bytes(20));
            // Con 20 digitos aleatorios es más probable que yo gane el nobel 50 veces seguidas a que dos contraseñas sean iguales

            // Terminamos de guardar los datos en la base de datos incluyen el salt
            Usuarios::where('username', session('username'))->update(['nombre' => $nombre, 'contrasena' => hash('sha256', $contrasena.$salt), 'edad' => $edad, 'sexo' => $sexo, 'pais' => $pais, 'salt' => $salt]);
            return response()->json(['success' => $salt]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar los datos']);
        }
    }

    public function login(Request $request){
        // Extraemos los datos del json
        $datos = $request->json()->all();
        $username = (string)$datos['username'];
        $contrasena = (string)$datos['contrasena'];
        // Buscamos el usuario en la base de datos
        $usuario = Usuarios::where('username', $username)->first();
        if ($usuario) {
            // Extraemos el salt del usuario
            $salt = $usuario->salt;
            session(['user_id' => $usuario->id]);
            // Comprobamos si la contraseña es correcta
            if ($usuario->contrasena == hash('sha256', $contrasena.$salt)) {
                // Creamos un token que contendo que ponga logeado y lo ponemos en la cookie
                $token = hash('sha256', $usuario->id.$salt);
                setcookie('tokenUsuarioCodeLink', $token, time() + 3600, '/');
                // Guardamos el username del usuario en una variable de sesión
                session(['username' => $usuario->username]);
                
                return response()->json(['success' => 'Usuario logueado']);
            }
            else{
                return response()->json(['error' => 'Ha habido un error al loguear el usuario']);
            }
        }
        else{
            return response()->json(['error' => 'Ha habido un error al loguear el usuario']);
        }
    }


    public function mostrarInicio(){
        // Llamamos a la funcion comprobarToken del TokenController para comprobar si hay un token en la cookie
        return view('inicio');
        
        
    }


    public function buscar(Request $request)
    {
        $buscar = $request->input('search');
        // Buscamos los usuarios que contengan el nombre que se ha introducido en el input menos el usuario que ha hecho la busqueda que esta en session username
        $usuarios = Usuarios::where('username', 'like', '%'.$buscar.'%')->where('username', '!=', session('username'))->get();
        $solicitudes = Solicitudes::where('usuario_emisor_id', session('user_id'))->get();
        $amistades = Amistades::where('usuario1_id', session('user_id'))->get();

        return view('buscados', ['usuarios' => $usuarios, 'solicitudes' => $solicitudes, 'amistades' => $amistades]);
        
    }






















    
    




    public function mostrarMisImagenes()
    {
        $fotos = Fotos::where('id_usuario', session('user_id'))->get();
        
        return view('misimagenes', ['fotos' => $fotos]);
    }






}

