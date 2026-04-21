<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialite;
use App\Models\Medecin;
use Illuminate\Support\Facades\Auth;


class PatientController extends Controller
{
    //
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'patient'){
            abort(404,'pas autorise');

        }
        
        $specialites = Specialite::all();

        $specialiteId = $request->query('specialite');
        $medecinId = $request->query('medecin');
        $selectedHeure = $request->query('heure');
        $selectedDate = $request->query('date', now()->toDateString());


        $medecins = collect();

        if ($specialiteId) {
            $medecins = Medecin::with(['user', 'specialite'])
                ->where('specialite_id', $specialiteId)
                ->get();
        }


        $slots = collect();
        $allSlots = [
            '09:00',
            '09:30',
            '10:00',
            '10:30',
            '11:00',
            '11:30',
            '14:00',
            '14:30',
            '15:00',
            '15:30',
            '16:00',
            '16:30',
        ];
        if ($medecinId) {
            $bookedSlots = \App\Models\RendezVous::where('medecin_id', $medecinId)
                ->where('date_rendez_vous', $selectedDate)
                ->pluck('heure_rendez_vous')
                ->map(fn($time) => substr($time, 0, 5))
                ->toArray();
            
            $isToday = $selectedDate === now()->toDateString();
            
            $slots = collect($allSlots)->map(function ($slot) use ($bookedSlots,$isToday) {
                $isBooked = in_array($slot, $bookedSlots);
                $hasPassed = $isToday && $slot <= now()->addMinutes(60)->format('H:i');
                return [
                    'time' => $slot,
                    'available' => !$isBooked && !$hasPassed,
                ];
            });
        }

        

        // form handling final request post !
        $selectedSpecialite = null;
        $selectedMedecin = null;
        if ($specialiteId) {
            $selectedSpecialite = Specialite::find($specialiteId);
        }

        if ($medecinId) {
            $selectedMedecin = Medecin::with(['user', 'specialite'])->find($medecinId);
        }





        return view('patient.dashboard', compact(
            'user',
            'specialites',
            'medecins',
            'specialiteId',
            'medecinId',
            'selectedDate',
            'slots',
            'selectedHeure',
            'selectedSpecialite',
            'selectedMedecin'
        ));
    }

    public function rendezVousIndex()
    {
        $user = Auth::user();
        if ($user->role !== 'patient' || !$user->patient) {
            abort(403, 'Non autorisé.');
        }

        // Fetch all appointments for the patient, ordered by date and time
        $allRendezVous = \App\Models\RendezVous::with(['medecin.user', 'medecin.specialite'])
            ->where('patient_id', $user->patient->id)
            ->orderBy('date_rendez_vous', 'desc')
            ->orderBy('heure_rendez_vous', 'desc')
            ->get();

        // Split into "Upcoming" vs "Past"
        $today = now()->toDateString();
        
        $upcoming = $allRendezVous->filter(function ($rdv) use ($today) {
            return $rdv->date_rendez_vous >= $today && $rdv->statut !== 'annulé';
        })->sortBy('date_rendez_vous')->sortBy('heure_rendez_vous');

        $past = $allRendezVous->filter(function ($rdv) use ($today) {
            return $rdv->date_rendez_vous < $today || $rdv->statut === 'annulé';
        });

        return view('patient.rendezvous', compact('user', 'upcoming', 'past'));
    }
}
