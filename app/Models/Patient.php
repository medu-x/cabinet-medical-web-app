<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // zdt hada bach y9dr user ukon 3ndo bzf tles reservation
    public function rendezVous(): HasMany
    {
        return $this->hasMany(RendezVous::class);
    }
}
