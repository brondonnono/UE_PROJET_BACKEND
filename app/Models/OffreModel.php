<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreModel extends Model
{
    use HasFactory;
    protected $table = "offres";
    public $timestamps = true;

    protected $fillable = [
        'employeur_id',
        'libelle',
        'description',
        'dateExpiration',
        'posteVise',
        'competencesRequises',
        'typeOffre',
        'ville',
        'img'
    ];
}
