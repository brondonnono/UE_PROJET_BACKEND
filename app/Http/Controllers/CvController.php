<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployerModel;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Utils\utilController;

class CvController extends Controller
{
    public function download(Request $request, $id) {
        $employer = EmployerModel::find($id);
        if(is_null($employer)) {
            return response()->json(["message" => "Aucune cv trouvé avec cet identifiant d'employé", "status" => "404"], 404);
        }
        $fileName = (new utilController)->getCvFileName($employer->cv);
        $file_name = 'cv/'.$fileName;
        return response()->download(public_path($file_name));
    }

    public function upload(Request $request) {
        $files = $request->file('cv');
        $filename  = $files->getClientOriginalName();
        $fileNameOnly = explode('.', $filename)[0];
        $folder = "cv";
        $extension = $files->getClientOriginalExtension();
        $cv = str_replace(' ', '_', $fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
        $files->move(public_path($folder), $cv);
        $cvURL = url($folder.'/'.$cv);
        return response()->json(["url" => $cvURL], 200);
    }

    public function downloadImg(Request $request) {
        
        $file_name = '4_userProfil.png';
        $folder = "avatars";
        return response()->download(public_path($folder.'/'.$file_name), 'user_profil');
    }

    public function uploadImg(Request $request) {
        if(!$request->hasFile('img')) {
            return response()->json(['message'=>'Aucune img sélectionnée'], 400);
        }
        $allowedFileExtension=['jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG'];
        $files = $request->file('img');
        $folder = "avatars";
        $extension = $files->getClientOriginalExtension();
        $check = in_array($extension, $allowedFileExtension);
        if($check) {
            $filename  = $files->getClientOriginalName();
            $fileNameOnly = explode('.', $filename)[0];
            $picture = str_replace(' ', '_', $fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
            $files->move(public_path($folder), $picture);
            $imgURL = url($folder.'/'.$picture);
        } else {
            return response()->json(['message'=>'format de fichier invalide'], 422);
        }
        return response()->json(['url'=> $imgURL], 200); 
    }
}
