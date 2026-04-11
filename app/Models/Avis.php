<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $table = 'avis';

    protected $fillable = [
        'rendez_vous_id',
        'note',
        'commentaire',
    ];

    public function rendezVous()
    {
        return $this->belongsTo(RendezVous::class);
    }
}
