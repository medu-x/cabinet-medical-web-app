<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['user_id', 'cin', 'date_naissance', 'telephone', 'adresse'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dossierMedical()
    {
        return $this->hasOne(\App\Models\DossierMedical::class);
    }
}
