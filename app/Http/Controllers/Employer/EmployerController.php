<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \stdClass;

use App\Http\Controllers\Utils\utilController;
use App\Http\Controllers\Offre\OffreController;
use App\Models\EmployerModel;

class EmployerController extends Controller
{
    public function getEmployers() {
        $employerList = EmployerModel::paginate();
        $response = response()->json($employerList, 200);
        $result = $response->getData(false, 512);

        if(($result->data == [])) {
            return response()->json(["message" => "Aucun employé trouvé"], 404);
        }
        return $response;
    }

    public function getEmployerByID($id) {
        $employer = EmployerModel::find($id);
        if(is_null($employer)) {
            return response()->json(["message" => "Aucun employé trouvé avec cet identifiant"], 404);
        }
        return response()->json($employer, 200);
    }

    public function createEmployer(Request $request) {
        $rules = [
            'sexe' => 'required|max:1',
            'user_id' => 'required',
            'DateNais' => 'required',
            'villeResidence' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $employer = EmployerModel::create($request->all());
        return response()->json($employer, 201);
    }

    public function updateEmployer(Request $request, $id) {
        $employer = EmployerModel::find($id);
        if(is_null($employer)) {
            return response()->json(["message" => "Modification impossible! employé inexistant"], 404);
        }
        $employer->update($request->all());
        return response()->json($employer, 200);
    }

    public function deleteEmployer(Request $request, $id) {
        $employer = EmployerModel::find($id);
        if(is_null($employer)) {
            return response()->json(["message" => "Suppression impossible! employé inexistant"], 404);
        }
        $employer->delete();
        return response()->json(["message" => "Employé supprimé avec succès. Veuillez supprimer aussi son compte utilisateur"], 200);
    }

    public function getRecommandedOffresForUser(Request $request, $id) {
        $recommandation = array();
		$secondRecommandation = array();
		$recommandationOffres = new stdClass();
        $employer = new \stdClass();
        $user = $this->getEmployerByID($id)->getData();
        $employer->competences = (new utilController)->makeCompetenceArrayFormString($user->competences);
        $employer->nom = $user->nom;
        $employer->id = $user->id;
        $offre = (new OffreController)->getOffres()->getData();
        
        for ($i=0; $i < sizeof($offre->data); $i++) {
            $offre->data[$i]->competencesRequises = (new utilController)->makeCompetenceArrayFormString($offre->data[$i]->competencesRequises);
        }
		$recommandationOffres->user_id = $employer->id;
		$recommandationOffres->user_competences = $employer->competences;
        
		for( $i = 0; $i < sizeof($offre->data); $i++) {
			$macthRate = 0;
			for( $j = 0; $j < sizeof($offre->data[$i]->competencesRequises); $j++) {
				for( $k = 0; $k < sizeof($employer->competences); $k++) {
					if ( $employer->competences[$k] == $offre->data[$i]->competencesRequises[$j]) {
						$macthRate++;
					}
				}
			}
			if( $macthRate == sizeof($offre->data[$i]->competencesRequises)) {
				$result = new stdClass();
				$result->offre_id = $offre->data[$i]->id;
				$result->offre_competences = $offre->data[$i]->competencesRequises;
				$result->macthRate = $macthRate;
				$recommandation[$i] = response()->json($result)->getData();
			} else if($macthRate >= 1 && $macthRate < sizeof($offre->data[$i]->competencesRequises)) {
				$result = new stdClass();
				$result->offre_id = $offre->data[$i]->id;
				$result->offre_competences = $offre->data[$i]->competencesRequises;
				$result->macthRate = $macthRate;
				$secondRecommandation[$i] = response()->json($result)->getData();
			}
		}
		
		$recommandationOffres->Size = sizeof($recommandation);
		$recommandationOffres->Offres = $recommandation;
		
		$recommandationOffres->Taille = sizeof($secondRecommandation);
		$recommandationOffres->AutresOffres = $secondRecommandation;
		
		if (sizeof($recommandation)==0 && sizeof($secondRecommandation)==0) {
			return response()->json(["message" => "Pour le moment aucune offre ne concorde avec vos compétences", "macthRate" => $macthRate], 404);
        }
        return $recommandationOffres;
    }
}
 