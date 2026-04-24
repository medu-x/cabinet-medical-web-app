<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    use HasFactory;

    //
    protected $table = 'specialites';
    protected $fillable = [
        'nom',
        'description',
        'prix_consultation',
    ];


    /// get all deja difini dans laravel ();

}
