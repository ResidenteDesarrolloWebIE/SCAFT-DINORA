<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Projects\Project;
use App\Models\Projects\Image;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ImageController extends Controller{
    public function postUpload(Request $request){
        $form_data = $request->all();
        $validator = Validator::make($form_data, Image::$rules, Image::$messages);
        if ($validator->fails()) {
            return Response::json(['error' => true,'message' => $validator->messages()->first(),'code' => 400], 400);
        }  
        $image = $form_data['file'];
        $idProject = $form_data['idProject'];
        $extension = $image->getClientOriginalExtension();
        $folioOffer = $form_data['folioOffer'];
        $folioProject = $form_data['folioProject'];
        $typeProject = $form_data['typeProject'];
        $date = Carbon::now();

        $idImage = Image::latest('created_at')->first();
        if(is_null($idImage)){$countImage = 0;}
        else{$countImage = $idImage->id +1;}

        $nameImage = $folioOffer.'_'.$folioProject.'_'.$date->format('d-m-Y').'_'.str_replace(":", "-", $date->toTimeString()).'_'.$countImage.'.'.$extension; /* count */
        $ruta = '/Galeria/'.$folioOffer.'/'.$folioProject.'/Galeria/'.$typeProject.'/'.$nameImage;
        Storage::disk('local')->put($ruta, \File::get($image));
        
        $projectImage = new Image;
        $projectImage->name= $nameImage;
        $projectImage->size= $image->getClientSize();
        $projectImage->project_id = $idProject;
        $projectImage->save();

        return Response::json(['error' => false,'code'  => 200,'message' => "Imagen cargada correctamente"], 200);
    }

    public function deleteUpload(Request $request){
        $filename = $request->get('id');
        $folioOffer =  $request->get('folioOffer');
        $folioProject =  $request->get('folioProject');
        $typeProject =  $request->get('typeProject');
        if(!$filename){
            return 0;
        }
        $projectImage = Image::where('name', '=', $filename)->first();
        if(!empty($projectImage)){
            $projectImage->delete();
            Storage::delete(Storage::url('Galeria/').$folioOffer.'/'.$folioProject.'/Galeria'.$typeProject.'/'.$filename);
            return Response::json(['error' => false,'code'  => 200], 200);
        }else{
            return Response::json(['error' => true,'code'  => $projectImage], 400);
        }
    }
    

    public function getServerImages(Request $request){
        $idProject = $request->id;

        $project = Project::with('product','service')->where('id',$idProject)->first();

        if(is_null($project->service)){ /* Suministro */
            $folioOffer = $project->product->folio;
            $typeProject = "Suministro";
            $folioProject = $project->folio;
        }else{/* Servicio */
            $folioOffer = $project->service->folio;
            $typeProject = "Servicio";
            $folioProject = $project->folio ;
        }
        $images = Image::where('project_id',$idProject )->get();
        $imageAnswer = [];
        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->name, 
                'server' => Storage::url('Galeria/').$folioOffer.'/'.$folioProject.'/Galeria/'.$typeProject.'/'.$image->name,
                'size' => $image->size
            ];
        }
        return response()->json(['images' => $imageAnswer]);
    }
    
    public function showImagesGallery(Request $request){
        $idProject = $request->id;
        $images =  Image::where('project_id',$idProject )->get();
        return response()->json(['images' => $images]);
    }
}