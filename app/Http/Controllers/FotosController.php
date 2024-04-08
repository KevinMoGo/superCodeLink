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

         // Ahora guardamos en la base de datos en los campos id_foto y al ser autoincrementable se guarda solo. id_foto, id_usuario, titulo, ruta y fecha que es un varchar
            $foto = new Fotos();
            $foto->id_usuario = session('user_id');
            $foto->titulo = $request->titulo;
            $foto->descripcion = $request->descripcion;
            $foto->ruta = $filename;
            $foto->fecha = date('Y-m-d H:i:s');
            $foto->save();
            // Redirigir al usuario a la página de inicio
            return redirect()->route('inicio');


            
}

public function eliminarFoto($id_foto)
    {
        // Buscamos la foto por su ID y la eliminamos
        $foto = Fotos::find($id_foto);
        if ($foto) {
            $foto->delete();
        }

        // permanecemos en la misma página
        return redirect()->route('misimagenes');
        

    }


}