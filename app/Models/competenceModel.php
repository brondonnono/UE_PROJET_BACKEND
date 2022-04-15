<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class competenceModel extends Model
{
    use HasFactory;
    protected $table = "competences";
    public $timestamps = true;

    protected $fillable = [
        'id',
        'label',
        'experience'
    ];
}
