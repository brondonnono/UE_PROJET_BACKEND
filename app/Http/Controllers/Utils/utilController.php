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

    // public function makeCompetenceArrayFromString($competences) {
    //     return explode(';', $competences);
    // }

    public function makeCompetenceArrayFromString($competences) {
        return explode(',', $competences);
    }

    public function makeCompetenceExperienceArrayFromString($competence) {
        return explode(':', $competence);
    }

    public function getCvFileName($url) {
        $tab = explode('/', $url);
        return $tab[4];
     }
}
