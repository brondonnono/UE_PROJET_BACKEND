<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeurModel extends Model
{
    use HasFactory;
    protected $table = "employeurs";
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'nom',
        'description',
        'Secteur_activité',
        'ville',
        'avatar',
    ];
}
