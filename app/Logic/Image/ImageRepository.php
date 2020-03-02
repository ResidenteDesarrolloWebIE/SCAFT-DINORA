<?php

namespace App\Logic\Image;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use App\Models\Projects\Image;


class ImageRepository
{
    public function upload( $form_data){
        $validator = Validator::make($form_data, Image::$rules, Image::$messages);
        if ($validator->fails()) {
            return Response::json(['error' => true,'message' => $validator->messages()->first(),'code' => 400], 400);
        }
        $image = $form_data['file'];
        $idProject = $form_data['idProject'];
        $nameProject = $form_data['nameProject'];
        $originalName = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $fileName = $originalName . $extension;

        \Storage::disk('local')->put($originalName, \File::get($image));
        $projectImage = new Image;
        $projectImage->name= $originalName;
        $projectImage->project_id = $idProject;
        $projectImage->save();
        return Response::json(['error' => false,'code'  => 200,'filename' => $fileName], 200);
    }

    public function delete( $filename ){
        $projectImage = Image::where('name', '=', $filename)->first();
        if(!empty($projectImage)){
            $projectImage->delete();
            Storage::delete(Storage::url('imagesProjects/').$filename);
            return Response::json(['error' => false,'code'  => 200], 200);
        }else{
            return Response::json(['error' => true,'code'  => $projectImage], 400);
        }
    }
}