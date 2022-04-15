<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offerRejected extends Model
{
    use HasFactory;
    protected $table = "offerRejected";
    public $timestamps = true;

    protected $fillable = [
        'id',
        'employe_id',
        'offre_id'
    ];
}
