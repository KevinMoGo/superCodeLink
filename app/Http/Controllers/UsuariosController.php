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





//     <script type="text/javascript">
//     function registroUsuario(){
//         let nombre = document.getElementById('nombre').value;
//         let usuario = document.getElementById('usuario').value;
//         let contrasena = document.getElementById('contrasena').value;

//         if(nombre == '' || usuario == '' || contrasena == ''){
//             document.querySelector('.mensajeError1').style.display = 'block';
//             document.querySelector('.mensajeError2').style.display = 'none';
//         }
//         else{
//             fetch('creaUsuario', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//                 },
//                 body: JSON.stringify({
//                     nombre: nombre,
//                     usuario: usuario,
//                     contrasena: contrasena
//                 })
//             })
//         }
//     }
// </script>
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
            // retorna un json con un success
            return response()->json(['success' => 'Usuario creado']);
        }
        // Si el usuario ya existe, retornamos un json con un error
        return response()->json(['error' => 'El usuario ya existe']);

        
    }

    public function login()
    {
        // $usuario = Usuarios::where('username', request('nombre'))->where('contrasena', request('contrasena'))->first();
        // if($usuario){
        //     session(['user_id' => $usuario->id]);
        //     return redirect('inicio');
        // }else{
        //     return redirect('/');
        // }
        $usuario = Usuarios::where('username', request('username'))->first();
        if ($usuario) {
            if (hash('sha256', request('contrasena')) == $usuario->contrasena) {
                session(['user_id' => $usuario->id]);
                return redirect('inicio');
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    public function mostrarMisImagenes()
    {
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
