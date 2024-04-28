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
public function delete_post($id)
    {
        $foto = Fotos::find($id);
        $foto->delete();
        return response()->json(['success' => true]);
    }

public function editar_foto(Request $request)
    {
        // Obtenemos los valores de la petición
        $id = $request->id_fotoEdit;
        $titulo = $request->titulo;
        $descripcion = $request->descripcion;
        // Buscamos la foto por su id
        $foto = Fotos::find($id);
        // Actualizamos los valores
        $foto->titulo = $titulo;
        $foto->descripcion = $descripcion;
        // Guardamos los cambios
        $foto->save();
        // Mandamos un success
        return response()->json(['success' => true]);


    }

public function coger_datos($id)
    {
        // Buscamos la foto por su id
        $foto = Fotos::find($id);
        // Devolvemos la foto en formato json
        return response()->json($foto);
    }

    

}