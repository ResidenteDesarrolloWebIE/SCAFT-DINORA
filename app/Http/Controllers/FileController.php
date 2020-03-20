<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    function uploadFile() {
        $preview = $config = $errors = [];
        $file = 'file'; // the input name for the fileinput plugin
        if (empty($_FILES[$file])) {
            return [];
        }
        $total = count($_FILES[$file]['name']); // multiple files
        $path = '/uploads/'; // your upload path
        for ($i = 0; $i < $total; $i++) {
            $tmpFilePath = $_FILES[$file]['tmp_name'][$i]; // the temp file path
            $fileName = $_FILES[$file]['name'][$i]; // the file name
            $fileSize = $_FILES[$file]['size'][$i]; // the file size
            
            //Make sure we have a file path
            if ($tmpFilePath != ""){
                //Setup our new file path
                $newFilePath = $path . $fileName;
                $newFileUrl = 'http://localhost/uploads/' . $fileName;
                
                //Upload the file into the new path
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $fileId = $fileName . $i; // some unique key to identify the file
                    $preview[] = $newFileUrl;
                    $config[] = [
                        'key' => $fileId,
                        'caption' => $fileName,
                        'size' => $fileSize,
                        'downloadUrl' => $newFileUrl, // the url to download the file
                        'url' => 'http://localhost/delete.php', // server api to delete the file based on key
                    ];
                } else {
                    $errors[] = $fileName;
                }
            } else {
                $errors[] = $fileName;
            }
        }
        $out = ['initialPreview' => $preview, 'initialPreviewConfig' => $config, 'initialPreviewAsData' => true];
        if (!empty($errors)) {
            $img = count($errors) === 1 ? 'file "' . $error[0]  . '" ' : 'files: "' . implode('", "', $errors) . '" ';
            $out['error'] = 'Oh snap! We could not upload the ' . $img . 'now. Please try again later.';
        }
        return $out;
    }
}
