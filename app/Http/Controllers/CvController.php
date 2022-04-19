<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CvController extends Controller
{
    public function download() {
        $file_name = 'CV wilfried-old.pdf';
        return response()->download(public_path($file_name), 'user_cv');
    }

    public function upload(Request $request) {
        $file_name ='_CV.pdf';
        $path = $request->file('cv')->move(public_path("/"), $file_name);
        $cvURL = url('/'.$file_name);
        return response()->json(["url" => $cvURL], 200);
    }

    public function downloadImg(Request $request) {
        
        $file_name = '4_userProfil.png';
        $folder = "avatars";
        return response()->download(public_path($folder.'/'.$file_name), 'user_profil');
    }

    public function uploadImg(Request $request) {
        if(!$request->hasFile('img')) {
            return response()->json(['message'=>'Aucune image sélectionnée'], 400);
        }
        $allowedFileExtension=['jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG'];
        $files = $request->file('img');
        $folder = "avatars";

        $extension = $files->getClientOriginalExtension();
        $check = in_array($extension, $allowedFileExtension);
        if($check) {
            $file_name = $request->user_id.'_userProfil.png';
            $path = $request->img->move(public_path('/'.$folder), $file_name);
            $imgURL = url($folder.'/'.$file_name);
        } else {
            return response()->json(['message'=>'format de fichier invalide'], 422);
        }
        return response()->json(['url'=> $imgURL], 200); 
    }
}
