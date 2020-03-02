<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorageController extends Controller{

    //Guardar imagenes
    public function save(Request $request){
        $path = public_path().'/uploads/';
        $files = $request->file('file');
        foreach($files as $file){
            $fileName = $file->getClientOriginalName();
            $file->move($path, $fileName);
        }
/*        $file = $request->file('file'); //obtenemos el campo file definido en el formulario
       $nombre = $file->getClientOriginalName(); //obtenemos el nombre del archivo
       \Storage::disk('local')->put($nombre,  \File::get($file)); //indicamos que queremos guardar un nuevo archivo en el disco local */
       return "archivo guardado";
    }

    /* Recuperando las imagenes */
    
    public function showImages(Request $request){
        $archivo = $request->url;
        $public_path = public_path();
        $url = $public_path.'/storage/'.$archivo;//verificamos si el archivo existe y lo retornamos
        if (Storage::exists($archivo)){
            return response()->download($url);
        }
        abort(404); //si no se encuentra lanzamos un error 404.
    }

}
