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

    // Creamos una instancia de TokenController para poder usar sus métodos
    private $tokenController;
    public function __construct()
    {
        $this->tokenController = new TokenController();
    }


    public function registroUsername(Request $request)
    {

        // Extraemos el username del formulario
        $usuario = $request->input('usernameID');
        // Lo pasamos a string para evitar inyección de código
        $usuarioStr = (string)$usuario;
        
        // Buscamos si el usuario ya existe en la base de datos
        // $usuario = Usuarios::where('username', $usuario)->first();
        // if ($usuario) {
        //     return response()->json(['existe' => true]);
        // }
        // else{
        //     $usuario = new Usuarios();
        //     $usuario->username = $username;
        //     $usuario->save();
        //     return response()->json(['existe' => false]);
        // }
        $usuarioBuscado = Usuarios::where('username', $usuarioStr)->first();
        if ($usuarioBuscado) {
            return response()->json(['existe' => $usuarioStr]);
        }
        else{
            return response()->json(['existe' => $usuarioStr]);
        }
    }
    
    



    public function creaUsuario()
    {

        // Primero se comprueba si el usuario ya existe
        // Recogemos del json que nos llega los datos del usuario desde el fetch
        $datos = request()->json()->all();
        // Comprobamos si el usuario ya existe
        $usuario = Usuarios::where('username', $datos['usuario'])->first();
        // Si el usuario no existe, lo creamos
        if (!$usuario) {
            $usuario = new Usuarios();
            $usuario->nombre = $datos['nombre'];
            $usuario->username = $datos['usuario'];
            $usuario->contrasena = hash('sha256', $datos['contrasena']);
            $usuario->save();
            // Llama al método creaToken del TokenController para crear un token
            $this->tokenController->creaToken($usuario);
            
            // retorna un json con un success
            return response()->json(['success' => 'Usuario creado']);
        }
        // Si el usuario ya existe, retornamos un json con un error
        return response()->json(['error' => 'Error al crear el usuario']);

        
    }

    public function auth(Request $request)
    {
        // Recogemos la data enviados por el formulario
        $datos = $request->all();
        // Buscamos el usuario en la base de datos
        $usuario = Usuarios::where('username', $datos['username'])->where('contrasena', hash('sha256', $datos['contrasena']))->first();
       // Usa el método creaToken del TokenController para crear un token
        if ($usuario) {
            // Compromos si el usuario tiene ya un token llamando al método compruebaToken del TokenController
            if ($this->tokenController->compruebaToken($usuario)) {
                // Lo borramos y creamos uno nuevo
                $this->tokenController->eliminaToken();
                $this->tokenController->creaToken($usuario);
                return redirect('inicio');
            }
            // Si no tiene un token, creamos uno nuevo
            else{
                $this->tokenController->creaToken($usuario);
                return redirect('inicio');
            }
        }
        else{
            return redirect('/');
        }

        


    }

    public function mostrarMisImagenes()
    {
        $fotos = Fotos::where('id_usuario', session('user_id'))->get();
        return view('misimagenes', ['fotos' => $fotos]);
    }

    public function mostrarInicio(){
        // Comprobamos si el usuario tiene un token en la cookie
        if (isset($_COOKIE['tokenUsuarioCodeLink'])) {
            // Si lo tiene, verificamos si es válido
            if ($this->tokenController->compruebaToken()) {
                // llamamos a la funcion prueba del TokenController
                $this->tokenController->prueba();

                return view('inicio');
            }
            else{
                // Si no es válido, lo redirigimos al login
                return redirect('/');
            }
        }
        // Si no tiene un token, lo redirigimos al login
        return redirect('inicio');
        
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

