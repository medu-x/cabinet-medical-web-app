<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = ['ordonnance_id', 'medicament', 'dosage', 'frequence', 'instructions'];

    public function ordonnance()
    {
        return $this->belongsTo(Ordonnance::class);
    }
}
