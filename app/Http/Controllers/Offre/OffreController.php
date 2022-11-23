<?php

namespace App\Http\Controllers\Offre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\OffreModel;
use App\Http\Controllers\Employeur\EmployeurController;
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
        $offers = [];
        // for ($i=0; $i < sizeof($result); $i++) { 
        //     $offer->id = $response[$i]->id;
        //    $offer->employeur_id = $response[$i]->employeur_id;
        //    $offer->libelle = $response[$i]->libelle;
        //    $offer->description = $response[$i]->description;
        //    $offer->dateExpiration = $response[$i]->dateExpiration;
        //    $offer->posteVise = $response[$i]->posteVise;
        //    $offer->competencesRequises = $response[$i]->competencesRequises;
        //    $offer->typeOffre = $response[$i]->typeOffre;
        //    $offer->img = $this->getEmployeurImg($offer->employeur_id);
        //    $offer->created_at = $response[$i]->created_at;
        //    $offer->updated_at = $response[$i]->updated_at;
        //    $offers->push($offer);
        // }

        if(($result == [])) {
            return response()->json(["message" => "Aucune offre trouvée"], 404);
        }
        return $response;
    }

    public function getEmployeurImg($id) {
        $employeur = (new EmployeurController)->getEmployeurById($id);
        if ($employeur) {
            return response()->json($employeur->avatar, 200);         
        }
        return response()->json(["message" => "Aucun employeur trouvé avec cet identifiant"], 404);
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
            'typeOffre' => 'required',
            'ville' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $offre = OffreModel::create($request->all());
        $emp = (new EmployeurController)->internalGetEmployeurById($request->employeur_id);
        $offre->img = $emp->avatar;
        $offre = DB::update('update offres set img = ? where id = ?', [$offre->img, $offre->id]);
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
            return response()->json(["message" => "Aucune offre trouvée avec cet identifiant"], 404);
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
            return response()->json(["message" => "Aucune offre trouvée avec cet identifiant d'employé"], 404);
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
            return response()->json(["message" => "Modification impossible! offre inexistante"], 404);
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
            return response()->json(["message" => "Suppression impossible! offre inexistante"], 404);
        }
        $offre->delete();
        return response()->json(["message" => "Offre supprimée avec succès"], 200);
    }
}
