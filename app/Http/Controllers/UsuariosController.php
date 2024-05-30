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




    public function validarUsername($username){
        // Buscamos el usuario en la base de datos
        $usuario = Usuarios::where('username', $username)->first();
        // Si el usuario existe devolvemos un error
        if ($usuario) {
            return response()->json(['error' => 'El usuario ya existe']);
        }
        // Si el usuario no existe devolvemos un success
        else{
            return response()->json(['success' => 'El usuario no existe']);
        }
    }
    public function registro(Request $request){
        // Extraemos los datos del json
        $datos = $request->json()->all();
        $nombre = (string)$datos['nombre'];
        $username = (string)$datos['username'];
        $contrasena = (string)$datos['contrasena'];
        $edad = (string)$datos['edad'];
        $sexo = (string)$datos['sexo'];
        $pais = (string)$datos['pais'];
        // Buscamos el usuario en la base de datos
        $usuario = Usuarios::where('username', $username)->first();
        // Si el usuario existe devolvemos un error
        if ($usuario) {
            return response()->json(['error' => 'Ha habido un error al crear el usuario']);
        }
        // Si el usuario no existe lo creamos
        else{
            // Creamos un objeto de la clase Usuarios
            $usuario = new Usuarios();
            // Creamos un salt aleatorio
            $salt = bin2hex(random_bytes(32));
            // Guardamos los datos en el objeto
            $usuario->nombre = $nombre;
            $usuario->username = $username;
            $usuario->contrasena = hash('sha256', $contrasena.$salt);
            $usuario->edad = $edad;
            $usuario->sexo = $sexo;
            $usuario->pais = $pais;
            $usuario->salt = $salt;
            // Guardamos el objeto en la base de datos
            $usuario->save();
            return response()->json(['success' => 'Usuario creado']);

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
    public function mostrarInicio()
    {
        // Obtener el ID del usuario desde la sesión
        $userId = session('user_id');

        // Obtener todas las amistades donde el usuario es usuario1_id o usuario2_id
        $amistades = Amistades::where('usuario1_id', $userId)
                              ->orWhere('usuario2_id', $userId)
                              ->get();

        // Crear un array para almacenar las IDs de los amigos
        $amigosIds = [];

        foreach ($amistades as $amistad) {
            if ($amistad->usuario1_id == $userId) {
                // Si el usuario1_id es el usuario de la sesión, agregar usuario2_id
                $amigosIds[] = $amistad->usuario2_id;
            } else {
                // Si el usuario2_id es el usuario de la sesión, agregar usuario1_id
                $amigosIds[] = $amistad->usuario1_id;
            }
        }

        // Ahora extraemos los el nombre, username, edad, pais, sexo y PP de los amigos
        $amigos = Usuarios::whereIn('id', $amigosIds)->get();
        return view('inicio', ['amigos' => $amigos]);
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


    public function datosBarra(){
        $usuario = Usuarios::where('id', session('user_id'))->first();
        // retornamos el username, nombre, edad, sexo, pais y PP del usuario
        return response()->json(['username' => $usuario->username, 'nombre' => $usuario->nombre, 'edad' => $usuario->edad, 'sexo' => $usuario->sexo, 'pais' => $usuario->pais, 'PP' => $usuario->PP]);
    }

    public function datosEditar(){
        $usuario = Usuarios::where('id', session('user_id'))->first();
        // retornamos el nombre, username, edad, sexo, pais y PP del usuario
        return response()->json(['nombre' => $usuario->nombre, 'username' => $usuario->username, 'edad' => $usuario->edad, 'sexo' => $usuario->sexo, 'pais' => $usuario->pais]);
    }

    public function getDatosPerfil(){
        $usuario = Usuarios::where('id', session('user_id'))->first();
        // Retorna solo el nombre, username y PP
        return response()->json(['nombre' => $usuario->nombre, 'username' => $usuario->username, 'PP' => $usuario->PP]);
    }

    public function editarPerfil1(Request $request){
        // Extraemos los datos del json
        $datos = $request->json()->all();
        $nombre = (string)$datos['nombre'];
        $edad = (string)$datos['edad'];
        $sexo = (string)$datos['sexo'];
        $pais = (string)$datos['pais'];
        // Buscamos el usuario en la base de datos
        $usuario = Usuarios::where('id', session('user_id'))->first();
        // Guardamos los datos en el objeto y actualizamos la base de datos menos el username
        $usuario->nombre = $nombre;
        $usuario->edad = $edad;
        $usuario->sexo = $sexo;
        $usuario->pais = $pais;
        $usuario->save();
        return response()->json(['success' => 'Usuario actualizado']);

    }

    public function editarPerfil2(Request $request){
        // Extraemos los datos del json
        $datos = $request->json()->all();
        $username = (string)$datos['username'];
        $nombre = (string)$datos['nombre'];
        $edad = (string)$datos['edad'];
        $sexo = (string)$datos['sexo'];
        $pais = (string)$datos['pais'];
        // Comprobamos si ya existe el username
        $usuario = Usuarios::where('username', $username)->first();
        if ($usuario) {
            return response()->json(['error' => 'El usuario ya existe']);
        }
        else{
            // Buscamos el usuario en la base de datos
            $usuario = Usuarios::where('id', session('user_id'))->first();
            // Guardamos los datos en el objeto y actualizamos la base de datos
            $usuario->username = $username;
            $usuario->nombre = $nombre;
            $usuario->edad = $edad;
            $usuario->sexo = $sexo;
            $usuario->pais = $pais;
            $usuario->save();
            return response()->json(['success' => 'Usuario actualizado']);
        }
    }

    public function logout(){
        // Borramos la cookie
        setcookie('tokenUsuarioCodeLink', '', time() - 3600, '/');
        // Borramos la variable de sesión
        session()->forget('user_id');
        session()->forget('username');
        // respondemos con un success
        return response()->json(['success' => 'Usuario deslogueado']);
    }






















    
    




    public function mostrarMisImagenes()
    {
        $fotos = Fotos::where('id_usuario', session('user_id'))->get();
        
        return view('misimagenes', ['fotos' => $fotos]);
    }






}

