<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
}
 