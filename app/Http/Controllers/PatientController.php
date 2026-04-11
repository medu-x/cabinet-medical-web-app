<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialite;
use App\Models\Medecin;


class PatientController extends Controller
{
    //
    public function dashboard(Request $request)
    {
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
            $slots = collect($allSlots)->map(function ($slot) use ($bookedSlots) {
                return [
                    'time' => $slot,
                    'available' => !in_array($slot, $bookedSlots),
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
}
