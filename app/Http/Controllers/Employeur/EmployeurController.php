<?php

namespace App\Http\Controllers\Employeur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \stdClass;

use App\Http\Controllers\Utils\utilController;
use App\Http\Controllers\Offre\OffreController;
use App\Http\Controllers\Employer\EmployerController;
use App\Models\EmployeurModel;
use Illuminate\Support\Facades\DB;

class EmployeurController extends Controller
{
    /**
     * Display a listing of the Employeur.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmployeurs() {
        $employeurList = EmployeurModel::all();
        $response = response()->json($employeurList, 200);
        $result = $response->getData(false, 512);

        if(($result == [])) {
            return response()->json(["message" => "Aucun employeur trouvé"], 404);
        }
        return $response;
    }

    /**
     * Create and Store a newly Employeur in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function createEmployeur(Request $request)
    {
        $rules = [
            'Secteur_activité' => 'required',
            'user_id' => 'required',
            'adresse' => 'required',
            'email' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $employeur = EmployeurModel::create($request->all());
        return response()->json($employeur, 201);
    }

    /**
     * Display the specified Employeur.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEmployeurByID($id) {
        $employeur = EmployeurModel::find($id);
        if(is_null($employeur)) {
            return response()->json(["message" => "Aucun employeur trouvé avec cet identifiant"], 404);
        }
        return response()->json($employeur, 200);
    }

    public function internalGetEmployeurById($id) {
        $employeur = EmployeurModel::find($id);
        if(is_null($employeur)) {
            return "Aucun employeur trouvé avec cet identifiant";
        }
        return $employeur;
    }

    /**
     * Display the specified Employeur using userID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEmployeurByUserID($id) {
        $employeur = DB::table('employeurs')->where('user_id', $id)->first();
        if(is_null($employeur)) {
            return response()->json(["message" => "Aucun employeur trouvé avec cet identifiant d'utilisateur", "status" => "404"], 404);
        }
        return response()->json($employeur, 200);
    }

    /**
     * Update the specified Employeur in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEmployeur(Request $request, $id) {
        $employeur = EmployeurModel::find($id);
        if(is_null($employeur)) {
            return response()->json(["message" => "Modification impossible! employeur inexistant"], 404);
        }
        $employeur->update($request->all());
        return response()->json($employeur, 200);
    }

    /**
     * Remove the specified Employeur from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteEmployeur(Request $request, $id) {
        $employeur = EmployeurModel::find($id);
        if(is_null($employeur)) {
            return response()->json(["message" => "Suppression impossible! employeur inexistant"], 404);
        }
        $employeur->delete();
        return response()->json(["message" => "Employeur supprimé avec succès. Veuillez supprimer aussi son compte utilisateur"], 200);
    }

    /**
     * Display the Recommanded Employers Profils from offer id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getRecommandedProfilsForOffer($id) {
        $topUsers = array();
        $otherUsers = array();
        $recommandationProfils = new stdClass();
        $offer = new \stdClass();
        $offre = (new OffreController)->getOffreByID($id)->getData();
        $offer->competences = (new utilController)->makeCompetenceArrayFromString($offre->competencesRequises);
        $offer->id = $offre->id;
        $offer->employeur_id = $offre->employeur_id;
        $users = (new EmployerController)->getEmployers()->getData();
        
        for ($i=0; $i < sizeof($users) ; $i++) { 
            $users[$i]->competences = (new utilController)->makeCompetenceArrayFromString($users[$i]->competences);
        }
        $recommandationProfils->offer_id = $offer->id;
        $recommandationProfils->offer_competences = $offer->competences;

        for( $i = 0; $i < sizeof($users); $i++) {
			$matchRate = 0;
            for( $j = 0; $j < sizeof($users[$i]->competences); $j++) {
				for( $k = 0; $k < sizeof($offer->competences); $k++) {
					if ( $offer->competences[$k] == $users[$i]->competences[$j]) {
						$matchRate++;
					}
				}
			}

            if( $matchRate == sizeof($offer->competences)) {
				$result = new stdClass();
				$result->user_id = $users[$i]->id;
                $result->username = $users[$i]->nom;
				$result->user_competences = $users[$i]->competences;
				$result->matchRate = $matchRate;
				$topUsers[$i] = response()->json($result)->getData();
			} else if($matchRate >= 1 && $matchRate < sizeof($users[$i]->competences)) {
				$result = new stdClass();
				$result->user_id = $users[$i]->id;
                $result->username = $users[$i]->nom;
				$result->user_competences = $users[$i]->competences;
				$result->matchRate = $matchRate;
				$otherUsers[$i] = response()->json($result)->getData();
			}
        }

        $recommandationProfils->Size = sizeof($topUsers);
		$recommandationProfils->UsersTop = $topUsers;
		
		$recommandationProfils->Taille = sizeof($otherUsers);
		$recommandationProfils->OtherUsers = $otherUsers;
		
		if (sizeof($topUsers)==0 && sizeof($otherUsers)==0) {
			return response()->json(["message" => "Pour le moment aucun profil ne concorde avec cette offre", "matchRate" => $matchRate], 200);
        }
        return $recommandationProfils;
    }
}
