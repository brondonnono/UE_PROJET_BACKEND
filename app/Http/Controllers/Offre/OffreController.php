<?php

namespace App\Http\Controllers\Offre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OffreModel;

class OffreController extends Controller
{
    /**
     * Display a listing of the Offre.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOffres() {
        $nb_per_page = 10;
        $offreList = OffreModel::paginate($nb_per_page);
        $response = response()->json($offreList, 200);
        $result = $response->getData(false, 512);

        if(($result->data == [])) {
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

    public function createOffre(Request $request)
    {
        $rules = [
            'Secteur_activité' => 'required',
            'user_id' => 'required',
            'Description' => 'required',
            'ville' => 'required'
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
        $employer = OffreModel::find($id);
        if(is_null($offre)) {
            return response()->json(["message" => "Aucun offre trouvé avec cet identifiant"], 404);
        }
        return response()->json($offre, 200);
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
