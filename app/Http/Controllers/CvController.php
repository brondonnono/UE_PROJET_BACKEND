<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CvController extends Controller
{
    public function download() {
        $file_name = 'CV wilfried-old.pdf';
        return response()->download(public_path($file_name), 'user_cv');
    }

    public function upload(Request $request) {
        // $date = new date('Y-m-d HH:mm:ss');
        $file_name ='_CV.pdf';
        $path = $request->file('cv')->move(public_path("/"), $file_name);
        $cvURL = url('/'.$file_name);
        return response()->json(["url" => $cvURL], 200);
    }
}
