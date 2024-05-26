<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fotos;
use App\Models\Usuarios;
use App\Http\Controllers\UsuariosController;




class FotosController extends Controller
{

public function subirFoto(Request $request)
    {

       $filename = "";
       if ($request->hasFile('foto')) {
        // El nombre del archivo será la ruta de la foto
        $filename = '/assets/fotos/'. $request->foto->getClientOriginalName();
        $request->foto->move(public_path('/assets/fotos'), $filename);
    }

            $foto = new Fotos();
            $foto->id_usuario = session('user_id');
            $foto->titulo = $request->titulo;
            $foto->descripcion = $request->descripcion;
            $foto->ruta = $filename;
            $foto->fecha = date('Y-m-d H:i:s');
            $foto->save();
            return redirect()->route('misimagenes');


            
}


public function subirImagen(Request $request){
       $filename = "";
       if ($request->hasFile('foto')) {
        // Ahora vamos a verificar la composición de la imagen de modo que sepamos si es una imagen o no. asi evitamos que introduzcan ejecutables con formato de imagen
        $info = getimagesize($request->foto);
        if ($info === FALSE) {
            return response()->json(['error' => 'El archivo no es una imagen']);
        }
        else{
            // $filename = '/assets/fotos/'. $request->foto->getClientOriginalName();
            $uniqID = uniqid();
            $filename = '/assets/fotos/'. $uniqID . '.' . $request->foto->getClientOriginalExtension();
            
            $request->foto->move(public_path('/assets/fotos'), $filename);
            $foto = new Fotos();
            $foto->id_foto = $uniqID;
            $foto->id_usuario = session('user_id');
            $foto->titulo = $request->titulo;
            $foto->descripcion = $request->descripcion;
            $foto->ruta = $filename;
            $foto->fecha = date('Y-m-d H:i:s');
            $foto->save();
            // No hacemos nada, nos quedamos en la misma página
            return view('registroSubir');
        }
                
    
    
    }


}


public function subirFotoPerfil(Request $request)
    {

       $filename = "";
       if ($request->hasFile('fotoPerfil')) {
        // El nombre del archivo será la ruta de la foto
        $uniqID = uniqid();
        $filename = '/assets/fotosPerfil/'. $uniqID . '.' . $request->fotoPerfil->getClientOriginalExtension();
        $request->fotoPerfil->move(public_path('/assets/fotosPerfil'), $filename);


        // ahora hacemos un mime_content_type para comprobar que es una imagen
        $mime = mime_content_type(public_path($filename));
        // Si no es una imagen, eliminamos la foto de la carpeta y devolvemos un error
        if (strpos($mime, 'image') === false) {
            unlink(public_path($filename));
            return response()->json(['error' => 'El archivo no es una imagen']);
        }
        else{
            // Extraemos el id del usuario y guardamos la ruta de la foto en la base de datos
            $usuario = Usuarios::find(session('user_id'));
            $usuario->PP = $filename;
            $usuario->save();
            return response()->json(['success' => 'Foto de perfil subida correctamente']);
        }
    }
}











    public function deletepost(Request $request)
    {
        $id = $request->input('id_foto'); // Obtener el id_foto del request
        // Borramos la foto
        Fotos::where('id_foto', $id)->delete();
        
    }

    public function getpost(Request $request)
    {
        // Obtenemos el id de la foto
        $id = $request->input('id_foto');
        // Buscamos la foto en la base de datos y obtenemos el titulo y la descripción
        $foto = Fotos::where('id_foto', $id)->first();
        // Devolvemos el titulo y la descripción en formato JSON
        return response()->json(['titulo' => $foto->titulo, 'descripcion' => $foto->descripcion, 'id_foto' => $foto->id_foto]);
    }

    public function editpost(Request $request)
    {
        // Recogemos el titulo y la descripción del request
        $titulo = $request->input('titulo');
        $descripcion = $request->input('descripcion');

        
        // Actualizamos la foto en la base de datos 
        Fotos::where('id_foto', $request->input('id_foto'))->update(['titulo' => $titulo, 'descripcion' => $descripcion]);
        
    }
    

    

}