<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    protected $fillable = [
        'consultation_id',
        'medicament',
        'posologie',
        'frequence',
        'notes',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}
