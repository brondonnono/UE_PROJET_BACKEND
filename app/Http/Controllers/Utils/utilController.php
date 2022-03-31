<?php

namespace App\Http\Controllers\Utils;

use Illuminate\Http\Request;
use App\Models\EmployerModel;
use App\Http\Controllers\Controller;

class utilController extends Controller
{
    //convert a table off
    public function stringifyCompetences($competences) {
        $result = '';
        for ($i=0; $i < sizeof($competences); $i++) { 
            $result += $competences + ';';
        }
        return $result;
    }

    public function makeCompetenceArrayFormString($competences) {
       return explode(';', $competences);
    }
}
