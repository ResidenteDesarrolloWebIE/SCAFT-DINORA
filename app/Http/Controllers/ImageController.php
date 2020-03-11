<?php

namespace App\Http\Controllers;
use App\Logic\Image\ImageRepository;
use App\Models\Projects\Image;
use App\Models\Projects\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    protected $image;

    public function __construct(ImageRepository $imageRepository){
        $this->image = $imageRepository;
    }

    public function postUpload(Request $request){
        $photo = $request->all();
        $response = $this->image->upload($photo);
        return $response;
    }


    public function deleteUpload(Request $request){
        $filename = $request->get('id');
        $folioOffer =  $request->get('folioOffer');
        $folioProject =  $request->get('folioProject');
        $typeProject =  $request->get('typeProject');
        if(!$filename){
            return 0;
        }$response = $this->image->delete( $filename,$folioOffer,$folioProject,$typeProject);
        return $response;
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