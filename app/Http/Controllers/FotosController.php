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

public function eliminarImagen(Request $request)
    {
        $idImagen = $request->id;
        Fotos::find($idImagen)->delete();
        return response()->json(['success' => true]);
    }


}