<?php

namespace App\Http\Controllers;
use App\Logic\Image\ImageRepository;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use App\Models\Projects\Image;
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
        if(!$filename){
            return 0;
        }$response = $this->image->delete( $filename );
        return $response;
    }
    

    public function getServerImages(Request $request){
        $idProject = $request->id;
        $images = $supply = Image::where('project_id',$idProject )->get();
        $imageAnswer = [];
        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->name, 
                'server' => Storage::url('imagesProjects/').$image->name,
                'size' => File::size(public_path('storage/imagesProjects/'. $image->name))
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
