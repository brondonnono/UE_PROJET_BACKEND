<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerModel extends Model
{
    use HasFactory;
    protected $table = "employes";
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'nom',
        'sexe',
        'DateNais',
        'formations',
        'competences',
        'villeResidence',
        'cv'
    ];
}

// localhost:8000/api/createEmployer?user_id=1&nom=mac&sexe=M&DateNais=1549382956&formations=bacc,licence,master&competences=angular,ionic,laravel,sql&villeResidence=yaounde&cv=C:\Users\SCOFIELD\Downloads\CV wilfried-old.pdf
