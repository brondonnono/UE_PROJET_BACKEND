<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EmployerModel;

class EmployerController extends Controller
{
    public function employer() {
        return response()->json(EmployerModel::get(), 200);
    }

    public function employerByID($id) {
        return response()->json(EmployerModel::find($id), 200);
    }

    public function employerSave(Request $request) {
        $employer = EmployerModel::create($request->all());
        return response()->json($employer, 201);
    }
}
 