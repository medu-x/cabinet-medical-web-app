<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    //
    protected $table = 'specialites';
    protected $fillable = [
        'nom',
        'description',
        'prix_consultation',
    ];


    /// get all ();

}
