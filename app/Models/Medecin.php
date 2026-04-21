<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Avis;
use App\Models\RendezVous;

class Medecin extends Model
{
    protected $table = 'medecins';
    protected $fillable = [
        'user_id',
        'telephone',
        'bio',
        'experience',
        'photo_path',
        'specialite_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }

    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }

    public function averageRating()
    {
        return Avis::whereHas('rendezVous', function ($query) {
            $query->where('medecin_id', $this->id);
        })->avg('note') ?? 0;
    }

    public function reviewsCount()
    {
        return Avis::whereHas('rendezVous', function ($query) {
            $query->where('medecin_id', $this->id);
        })->count();
    }

    public function getLevelAttribute()
    {
        if ($this->experience > 5) {
            return 'Senior';
        } elseif ($this->experience > 2) {
            return 'Intermediate';
        }
        return 'Junior';
    }
    public function getPhotoUrlAttribute()
    {
        return $this->photo_path
            ? asset('storage/' . $this->photo_path)
            : ($this->user?->photo_url ?? asset('images/default-doctor.png'));
    }

    // rendez vous medcin de jour
    public function rendezVousDuJourConfirmed()
    {
        return $this->rendezVous()
            ->with(['patient.user'])    
            ->whereDate('date_rendez_vous', today())
            ->where('statut', 'confirmé')
            ->orderBy('heure_rendez_vous', 'asc')
            ->get();
    }
    public function rendezVousDuJourConfirmedCount()
    {
        return $this->rendezVous()
            ->whereDate('date_rendez_vous', today())
            ->where('statut', 'confirmé')
            ->count();
    }
    
    

    
}
