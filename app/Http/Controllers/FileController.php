<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DocumentController extends Controller
{
    function uploadFile($file, $quotation){
        try {
            $typeProject = "";
            $date = Carbon::now();
            $idFile = Document::latest('created_at')->first();
            $extension = $file->getClientOriginalExtension();
            if (
                is_null($idFile)
            ) {
                $countFile = 0;
            } else {
                $countFile = $idFile->id + 1;
            }
            $nameFile = $quotation->folio . '_' . $date->format('d-m-Y') . '_' . str_replace(":", "-", $date->toTimeString()) . '_' . $countFile . '.' . $extension;
            $ruta = '/Documents/' . $quotation->folio . '/' . '/Quotations/' . $typeProject . '/' . $nameFile;
            Storage::disk('local')->put($ruta, \File::get($file));
            return abort(response()->json(["message" => 'Los archivos fueron guardados correctamente'], 200));
        } catch (\Throwable $th) {
            return abort(response()->json(["message" => 'Los archivos no pudieron'], 400));
        }
    }
}