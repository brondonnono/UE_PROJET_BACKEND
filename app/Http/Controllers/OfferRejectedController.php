<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\offerRejected;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class OfferRejectedController extends Controller
{
    public function getOffersRejected() {
        $offerRejectedList = offerRejected::all();
        $response = response()->json($offerRejectedList, 200);
        $result = $response->getData(false, 512);

        if(($result == [])) {
            return response()->json(["message" => "Aucune offre rejetée n'a été trouvée"], 404);
        }
        return $response;
    }

    public function getOfferRejectedByID($id) {
        $offerRejected = offerRejected::find($id);
        if(is_null($offerRejected)) {
            return response()->json(["message" => "Aucune offre rejetée n'a été trouvée avec cet identifiant"], 404);
        }
        return response()->json($offerRejected, 200);
    }

    public function getOfferRejectedByEmployerID($id) {
        $offerRejected = DB::table('offerRejected')->where('employe_id', $id)->get();
        if(is_null($offerRejected)) {
            return response()->json(["message" => "Aucune offre rejetée par cet employé", "status" => "404"], 404);
        }
        if (sizeof($offerRejected)==0) {
            return response()->json(["message" => "Aucune offre rejetée par cet employé", "status" => "404"], 200);
        }
        $response = response()->json($offerRejected, 200);
        $result = $response->getData(false, 512);
        return $result;
    }

    public function createOfferRejected(Request $request) {
        $rules = [
            'employe_id' => 'required',
            'offre_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $offerRejected = offerRejected::create($request->all());
        return response()->json($offerRejected, 201);
    }

    public function deleteOfferRejected(Request $request, $id) {
        $offerRejected = offerRejected::find($id);
        if(is_null($offerRejected)) {
            return response()->json(["message" => "Suppression impossible! offre rejetée inexistante"], 404);
        }
        $offerRejected->delete();
        return response()->json(["message" => "Rejet d'offre supprimé avec succès"], 200);
    }
}
