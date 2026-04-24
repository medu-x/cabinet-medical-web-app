<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'rendez_vous_id',
        'patient_id',
        'medecin_id',
        'motif',
        'diagnostic',
        'rapport_medical',
        'statut'
    ];

    public function rendezVous()
    {
        return $this->belongsTo(RendezVous::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }

    public function ordonnance()
    {
        return $this->hasOne(Ordonnance::class);
    }

    public function ordonnances()
    {
        return $this->hasMany(Ordonnance::class);
    }
}
