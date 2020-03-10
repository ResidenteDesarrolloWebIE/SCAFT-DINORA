<?php

namespace App\Logic\Image;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use App\Models\Projects\Image;
use Carbon\Carbon;

class ImageRepository
{
    public function upload( $form_data){
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
        if(is_null($idImage)){
            $countImage = 0;
        }else{
            $countImage = $idImage->id +1;
        }

        $nameImage = $folioOffer.'_'.$folioProject.'_'.$date->format('d-m-Y').'_'.str_replace(":", "-", $date->toTimeString()).'_'.$countImage.'.'.$extension; /* count */
        $ruta = '/Galeria/'.$folioOffer.'/'.$folioProject.'/Galeria/'.$typeProject.'/'.$nameImage;
        Storage::disk('local')->put($ruta, \File::get($image));
        
        $projectImage = new Image;
        $projectImage->name= $nameImage;
        $projectImage->size= $image->getClientSize();
        $projectImage->project_id = $idProject;
        $projectImage->save();
        return Response::json(['error' => false,'code'  => 200,'filename' => $nameImage], 200);
    }

    public function delete($filename,$folioOffer,$folioProject,$typeProject){
        $projectImage = Image::where('name', '=', $filename)->first();
        if(!empty($projectImage)){
            $projectImage->delete();
            Storage::delete(Storage::url('Galeria/').$folioOffer.'/'.$folioProject.'/Galeria'.$typeProject.'/'.$filename);
            return Response::json(['error' => false,'code'  => 200], 200);
        }else{
            return Response::json(['error' => true,'code'  => $projectImage], 400);
        }
    }
}