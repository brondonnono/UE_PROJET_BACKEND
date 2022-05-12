<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\candidateModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class OfferPostulatedController extends Controller
{
    public function getOfferPostulatedByID($id) {
        $offerPostulated = candidateModel::find($id);
        if(is_null($offerPostulated)) {
            return response()->json(["message" => "Aucune offre postulée n'a été trouvée avec cet identifiant"], 404);
        }
        return response()->json($offerPostulated, 200);
    }

    public function getOfferPostulatedByEmployerID($id) {
        $offerPostulated = DB::table('candidate')->where('employe_id', $id)->get();
        if(is_null($offerPostulated)) {
            return response()->json(["message" => "Aucune offre postulée par cet employé", "status" => "404"], 404);
        }
        if (sizeof($offerPostulated)==0) {
            return response()->json(["message" => "Aucune offre postulée par cet employé", "status" => "404"], 200);
        }
        $response = response()->json($offerPostulated, 200);
        $result = $response->getData(false, 512);
        return $result;
    }
}
