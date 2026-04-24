<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    protected $fillable = ['consultation_id', 'date'];

    protected $casts = ['date' => 'date'];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
