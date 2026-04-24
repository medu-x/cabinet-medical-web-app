<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialite;
use App\Models\Medecin;
use App\Models\Avis;
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
        $dayOfWeek = \Carbon\Carbon::parse($selectedDate)->dayOfWeek; // 0=Sunday, 6=Saturday

        // Open Mon–Fri only (dayOfWeek 1–5)
        if ($medecinId && $dayOfWeek >= 1 && $dayOfWeek <= 5) {
            // Two blocks: 08:00–11:30 and 14:00–17:30
            $blocks = [
                ['08:00', '11:30'],
                ['14:00', '17:30'],
            ];

            $allSlots = [];
            foreach ($blocks as [$blockStart, $blockEnd]) {
                $cursor = \Carbon\Carbon::createFromFormat('H:i', $blockStart);
                $end    = \Carbon\Carbon::createFromFormat('H:i', $blockEnd);
                while ($cursor->lte($end)) {
                    $allSlots[] = $cursor->format('H:i');
                    $cursor->addMinutes(30);
                }
            }

            $bookedSlots = \App\Models\RendezVous::where('medecin_id', $medecinId)
                ->where('date_rendez_vous', $selectedDate)
                ->pluck('heure_rendez_vous')
                ->map(fn($time) => substr($time, 0, 5))
                ->toArray();

            $isPast  = $selectedDate < now()->toDateString();
            $isToday = $selectedDate === now()->toDateString();

            $slots = collect($allSlots)->map(function ($slot) use ($bookedSlots, $isPast, $isToday) {
                $isBooked  = in_array($slot, $bookedSlots);
                $hasPassed = $isPast || ($isToday && $slot <= now()->addMinutes(60)->format('H:i'));
                return [
                    'time'      => $slot,
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

    public function profil()
    {
        $user    = Auth::user();
        $patient = $user->patient;

        if (!$patient) abort(403, 'Non autorisé.');

        $patient->load('dossierMedical');

        $rendezVous = \App\Models\RendezVous::with(['medecin.user', 'medecin.specialite'])
            ->where('patient_id', $patient->id)
            ->orderBy('date_rendez_vous', 'desc')
            ->get();

        $consultations = \App\Models\Consultation::with([
                'ordonnance.prescriptions',
                'medecin.user',
                'medecin.specialite',
                'rendezVous.avis',
            ])
            ->where('patient_id', $patient->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient.profil', compact('user', 'patient', 'rendezVous', 'consultations'));
    }

    public function cancelRendezVous($id)
    {
        $user = Auth::user();
        if (!$user->patient) abort(403);

        $rdv = \App\Models\RendezVous::where('id', $id)
            ->where('patient_id', $user->patient->id)
            ->whereIn('statut', ['en_attente', 'confirmé'])
            ->firstOrFail();

        $slotDateTime = \Carbon\Carbon::parse($rdv->date_rendez_vous . ' ' . $rdv->heure_rendez_vous);
        if (now()->diffInHours($slotDateTime, false) < 2) {
            return back()->with('error', 'Annulation impossible : il reste moins de 2 heures avant votre rendez-vous.');
        }

        $rdv->update(['statut' => 'annulé']);
        return back()->with('success', 'Votre rendez-vous a été annulé avec succès.');
    }

    public function storeAvis(Request $request)
    {
        $user = Auth::user();
        if (!$user->patient) abort(403);

        $request->validate([
            'rendez_vous_id' => 'required|exists:rendez_vous,id',
            'note'           => 'required|integer|min:1|max:5',
            'commentaire'    => 'nullable|string|max:1000',
        ]);

        $rdv = \App\Models\RendezVous::where('id', $request->rendez_vous_id)
            ->where('patient_id', $user->patient->id)
            ->firstOrFail();

        if ($rdv->avis) {
            return back()->with('error', 'Vous avez déjà laissé un avis pour cette consultation.');
        }

        Avis::create([
            'rendez_vous_id' => $rdv->id,
            'note'           => $request->note,
            'commentaire'    => $request->commentaire,
        ]);

        return back()->with('success_avis', 'Merci pour votre avis !');
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
