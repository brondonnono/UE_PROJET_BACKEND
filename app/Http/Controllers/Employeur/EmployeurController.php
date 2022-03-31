<?php

namespace App\Http\Controllers\Employeur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\EmployeurModel;

class EmployeurController extends Controller
{
    /**
     * Display a listing of the Employeur.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmployeurs() {
        $employeurList = EmployeurModel::paginate();
        $response = response()->json($employeurList, 200);
        $result = $response->getData(false, 512);

        if(($result->data == [])) {
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
            'description' => 'required',
            'ville' => 'required'
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
        $employer = EmployeurModel::find($id);
        if(is_null($employeur)) {
            return response()->json(["message" => "Aucun employeur trouvé avec cet identifiant"], 404);
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
}
