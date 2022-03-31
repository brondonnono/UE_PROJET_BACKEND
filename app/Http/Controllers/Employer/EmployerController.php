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
        $recommandationOffres = array();
        $employer = new \stdClass();
        $user = $this->getEmployerByID($id)->getData();
        $employer->competences = (new utilController)->makeCompetenceArrayFormString($user->competences);
        $employer->nom = $user->nom;
        $employer->id = $user->id;
        $offre = (new OffreController)->getOffres()->getData();
        
        for ($i=0; $i < sizeof($offre->data); $i++) {
            $offre->data[$i]->competencesRequises = (new utilController)->makeCompetenceArrayFormString($offre->data[$i]->competencesRequises);
        }

        for ($i=0; $i < sizeof($employer->competences); $i++) {
            for ($j=0; $j < sizeof($offre->data); $j++) { 
                for ($k=0; $k < sizeof($offre->data[$j]->competencesRequises); $k++) { 
                    if($employer->competences[$i] === $offre->data[$j]->competencesRequises[$k]) {
                        $result = new stdClass();
                        $result->user_id = $employer->id;
                        $result->user_competences = $employer->competences;
                        $result->offre_id = $offre->data[$j]->id;
                        $result->offre_competences = $offre->data[$j]->competencesRequises;
                        $resultJSON = response()->json($result)->getData();
                        $recommandationOffres[$j] = $resultJSON;
                    }
                }
            }
        }
        
        return $recommandationOffres;
    }
}
 