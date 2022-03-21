<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerModel extends Model
{
    use HasFactory;
    protected $table = "employes";
    public $timestamps = false;

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
