<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \stdClass;

use App\Http\Controllers\Utils\utilController;
use App\Http\Controllers\Offre\OffreController;
use App\Http\Controllers\OfferRejectedController;
use App\Models\EmployerModel;
use App\Models\CandidateModel;
use App\Models\offerRejected;
use Illuminate\Support\Facades\DB;

class EmployerController extends Controller
{
    public function getEmployers() {
        $employerList = EmployerModel::all();
        $response = response()->json($employerList, 200);
        $result = $response->getData(false, 512);

        if(($result == [])) {
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

    public function getEmployerByUserID($id) {
        $employer = DB::table('employes')->where('user_id', $id)->first();
        if(is_null($employer)) {
            return response()->json(["message" => "Aucun employé trouvé avec cet identifiant d'utilisateur", "status" => "404"], 404);
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

    public function createCandidate(Request $request) {
        $rules = [
            'employe_id' => 'required',
            'offre_id' => 'required|unique:candidate,offre_id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $candidate = CandidateModel::create($request->all());
        return response()->json($candidate, 201);
    }

    public function deleteCandidate(Request $request, $id) {
        $candidate = CandidateModel::find($id);
        if(is_null($candidate)) {
            return response()->json(["message" => "Suppression impossible! candidature inexistante"], 404);
        }
        $candidate->delete();
        return response()->json(["message" => "Candidature supprimée avec succès"], 200);
    }

    public function getCandidateByOffreID($id) {
        $candidate = DB::table('candidate')->where('offre_id', $id)->first();
        if(is_null($candidate)) {
            return response()->json(["message" => "Aucune candidature trouvé avec cet identifiant d'offre", "status" => "404"], 404);
        }
        return response()->json($candidate, 200);
    }

    public function getCandidates() {
        $candidateList = CandidateModel::paginate();
        $response = response()->json($candidateList, 200);
        $result = $response->getData(false, 512);

        if(($result == [])) {
            return response()->json(["message" => "Aucune candidature trouvé"], 404);
        }
        return $response;
    }

    public function getCandidateByID($id) {
        $candidate = CandidateModel::find($id);
        if(is_null($candidate)) {
            return response()->json(["message" => "Aucune candidature trouvé avec cet identifiant"], 404);
        }
        return response()->json($candidate, 200);
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
        $employer->competences = (new utilController)->makeCompetenceArrayFromString($user->competences);
        $employer->nom = $user->nom;
        $employer->id = $user->id;
        $offre = (new OffreController)->getOffres()->getData();
        $offre = $this->removeRejectedOfferForCurrentUser($employer->id, $offre);

        if (sizeof($offre) > 0) {
            // for ($i=1; $i < sizeof($offre)+1; $i++) {
            //     $offre[$i]->competencesRequises = (new utilController)->makeCompetenceArrayFromString($offre[$i]->competencesRequises);
            // }

            foreach ( $offre as $item) {
                $item->competencesRequises = (new utilController)->makeCompetenceArrayFromString($item->competencesRequises);
            }
            $recommandationOffres->user_id = $employer->id;
            $recommandationOffres->user_competences = $employer->competences;
            
            $i = 0;
            foreach ($offre as $item) {
                $matchRate = 0;
                for( $j = 0; $j < sizeof($item->competencesRequises); $j++) {
                    for( $k = 0; $k < sizeof($employer->competences); $k++) {
                        if ( $employer->competences[$k] == $item->competencesRequises[$j]) {
                            $matchRate++;
                        }
                    }
                }
                if( $matchRate == sizeof($item->competencesRequises)) {
                    $result = new stdClass();
                    $result->offre_id = $item->id;
                    $result->offre_competences = $item->competencesRequises;
                    $result->matchRate = $matchRate;
                    $recommandation[$i] = response()->json($result)->getData();
                } else if($matchRate >= 1 && $matchRate < sizeof($item->competencesRequises)) {
                    $result = new stdClass();
                    $result->offre_id = $item->id;
                    $result->offre_competences = $item->competencesRequises;
                    $result->matchRate = $matchRate;
                    $secondRecommandation[$i] = response()->json($result)->getData();
                }
                $i++;
            }
            // for( $i = 1; $i < sizeof($offre)+1; $i++) {
            //     $matchRate = 0;
            //     for( $j = 0; $j < sizeof($offre[$i]->competencesRequises); $j++) {
            //         for( $k = 0; $k < sizeof($employer->competences); $k++) {
            //             if ( $employer->competences[$k] == $offre[$i]->competencesRequises[$j]) {
            //                 $matchRate++;
            //             }
            //         }
            //     }
            //     if( $matchRate == sizeof($offre[$i]->competencesRequises)) {
            //         $result = new stdClass();
            //         $result->offre_id = $offre[$i]->id;
            //         $result->offre_competences = $offre[$i]->competencesRequises;
            //         $result->matchRate = $matchRate;
            //         $recommandation[$i] = response()->json($result)->getData();
            //     } else if($matchRate >= 1 && $matchRate < sizeof($offre[$i]->competencesRequises)) {
            //         $result = new stdClass();
            //         $result->offre_id = $offre[$i]->id;
            //         $result->offre_competences = $offre[$i]->competencesRequises;
            //         $result->matchRate = $matchRate;
            //         $secondRecommandation[$i] = response()->json($result)->getData();
            //     }
            // }
            
            $recommandationOffres->Size = sizeof($recommandation);
            $recommandationOffres->Offres = $recommandation;
            
            $recommandationOffres->Taille = sizeof($secondRecommandation);
            $recommandationOffres->AutresOffres = $secondRecommandation;
            
            if (sizeof($recommandation)==0 && sizeof($secondRecommandation)==0) {
                return response()->json([
                    "message" => "Pour le moment aucune offre ne concorde avec vos compétences",
                    "matchRate" => $matchRate
                ], 404);
            }
            return $recommandationOffres;
        }
    }

    public function removeRejectedOfferForCurrentUser($employe_id, $offres) {
        $isRejected = (new OfferRejectedController)->getOfferRejectedByEmployerID($employe_id);
        $resut = array();
        if (!is_array($isRejected)) {
            return $offres;
        }
        for ($i=0; $i < sizeof($offres); $i++) { 
            $state = false;
            for ($j=0; $j < sizeof($isRejected); $j++) {
                if ($isRejected[$j]->offre_id == $offres[$i]->id) {
                    $state = true;
                }
            }
            if ($state == false) {
                $result[$i] = $offres[$i];
            }
        }
        return $result;
    }
}
 