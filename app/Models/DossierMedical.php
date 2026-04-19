<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DossierMedical extends Model
{
    protected $table = 'dossier_medical';

    protected $fillable = [
        'patient_id',
        'groupe_sanguin',
        'allergies',
        'antecedents',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
