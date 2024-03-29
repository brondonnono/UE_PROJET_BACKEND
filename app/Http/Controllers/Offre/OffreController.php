<?php

namespace App\Http\Controllers\Offre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\OffreModel;
use Illuminate\Support\Facades\DB;

class OffreController extends Controller
{
    /**
     * Display a listing of the Offre.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOffres() {
        $offreList = OffreModel::all();
        $response = response()->json($offreList, 200);
        $result = $response->getData(false, 512);

        if(($result == [])) {
            return response()->json(["message" => "Aucune offre trouvé"], 404);
        }
        return $response;
    }


    /**
     * Create and Store a newly Offre in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function createOffre(Request $request){
        $rules = [
            'employeur_id' => 'required',
            'libelle' => 'required',
            'description' => 'required',
            'dateExpiration' => 'required',
            'posteVise' => 'required',
            'competencesRequises' => 'required',
            'typeOffre' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $offre = OffreModel::create($request->all());
        return response()->json($offre, 201);
    }

    /**
     * Display the specified Offre.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOffreByID($id) {
        $offre = OffreModel::find($id);
        if(is_null($offre)) {
            return response()->json(["message" => "Aucun offre trouvé avec cet identifiant"], 404);
        }
        return response()->json($offre, 200);
    }

    /**
     * Display a listing of Offre from employeur_id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOffresByEmployeurId($id) {
        $offres = DB::table('offres')->where('employeur_id', $id)->get();
        if(is_null($offres) || sizeof($offres)==0) {
            return response()->json(["message" => "Aucun offre trouvé avec cet identifiant d'employé"], 404);
        }
        return response()->json($offres, 200);
    }

    /**
     * Update the specified Offre in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOffre(Request $request, $id) {
        $offre = OffreModel::find($id);
        if(is_null($offre)) {
            return response()->json(["message" => "Modification impossible! offre inexistant"], 404);
        }
        $offre->update($request->all());
        return response()->json($offre, 200);
    }

    /**
     * Remove the specified Offre from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteOffre(Request $request, $id) {
        $offre = OffreModel::find($id);
        if(is_null($offre)) {
            return response()->json(["message" => "Suppression impossible! offre inexistant"], 404);
        }
        $offre->delete();
        return response()->json(["message" => "Offre supprimé avec succès. Veuillez supprimer aussi son compte utilisateur"], 200);
    }
}
