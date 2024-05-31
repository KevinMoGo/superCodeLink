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
    // Creamos una variable de sesion llamada secreto



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
                // Creamos un token que contenga que ponga logeado y lo ponemos en la cookie
                $token = hash('sha256', $usuario->id.$salt);
                return response()->json(['success' => 'Usuario logueado'])
                    ->cookie('tokenUsuarioCodeLink', $token, 3600, '/', '', false, true); // La última true es para hacer la cookie httponly
                echo $token;
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
    
        // Debug: Verificar que amigosIds contiene los datos esperados
        
        
        // Extraer las fotos de los amigos
        $fotosAmigos = Fotos::whereIn('id_usuario', $amigosIds)->get();
    
        // ordenar las fotos por fecha de creación
        $fotosAmigos = $fotosAmigos->sortByDesc('created_at');
        
    
        // Extraer los detalles de los amigos
        $amigos = Usuarios::whereIn('id', $amigosIds)->get();
        
        return view('inicio', ['amigos' => $amigos, 'fotosAmigos' => $fotosAmigos]);
    }
    


    public function buscar(Request $request)
    {
        $buscar = $request->input('search');
        $userId = session('user_id');
        $username = session('username');
    
        // Buscamos los usuarios que contengan el nombre que se ha introducido en el input menos el usuario que ha hecho la búsqueda
        $usuarios = Usuarios::where('username', 'like', '%' . $buscar . '%')
                            ->where('id', '!=', $userId)
                            ->get();
    
        $solicitudes = Solicitudes::where('usuario_emisor_id', $userId)->get();
    
        // Buscamos amistades donde el usuario puede ser usuario1_id o usuario2_id
        $amistades = Amistades::where('usuario1_id', $userId)
                              ->orWhere('usuario2_id', $userId)
                              ->get();
    
        return view('buscados', ['usuarios' => $usuarios, 'solicitudes' => $solicitudes, 'amistades' => $amistades]);
    }
    
    

    public function error404(){
        return view('error404');
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

    // Route::get('/perfilUsuario/{id}', [UsuariosController::class, 'perfilUsuario']);

    public function perfilUsuario($id)
    {
        // Buscamos el usuario en la base de datos
        $usuario = Usuarios::where('id', $id)->first();
        // Si el usuario no existe devolvemos un error
        if (!$usuario) {
            return response()->json(['error' => 'El usuario no existe']);
        }
        // Si el usuario existe devolvemos un success
        else{
            // retornamos el username, nombre, edad, sexo, pais y PP del usuario
            return response()->json(['username' => $usuario->username, 'nombre' => $usuario->nombre, 'edad' => $usuario->edad, 'sexo' => $usuario->sexo, 'pais' => $usuario->pais, 'PP' => $usuario->PP]);
        }
    }





















    
    




    public function mostrarMisImagenes()
    {
        $fotos = Fotos::where('id_usuario', session('user_id'))->get();
        
        return view('misimagenes', ['fotos' => $fotos]);
    }






}

