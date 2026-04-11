<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RendezVousController extends Controller
{
    public function storeRendezVous(Request $request)
    {
        $request->validate([
            'medecin_id' => ['required', 'exists:medecins,id'],
            'date_rendez_vous' => ['required', 'date'],
            'heure_rendez_vous' => ['required'],
        ]);

        $exists = RendezVous::where('medecin_id', $request->medecin_id)
            ->where('date_rendez_vous', $request->date_rendez_vous)
            ->where('heure_rendez_vous', $request->heure_rendez_vous)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Ce creneau est deja reserve.');
        }

        $user = Auth::user();

        if (! $user->patient) {
            return back()->with('error', 'Aucun profil patient trouve pour cet utilisateur.');
        }

        $rendezVous = RendezVous::create([
            'patient_id' => $user->patient->id,
            'medecin_id' => $request->medecin_id,
            'date_rendez_vous' => $request->date_rendez_vous,
            'heure_rendez_vous' => $request->heure_rendez_vous,
            'statut' => 'en_attente',
            'notes' => null,
        ]);

        return redirect()
            ->route('rendezvous.confirmation', $rendezVous->id)
            ->with('success', 'Rendez-vous reserve avec succes.');
    }

    public function confirmation($id)
    {
        $user = Auth::user();

        if (! $user->patient) {
            abort(403);
        }

        $rendezVous = RendezVous::with(['medecin.user', 'medecin.specialite', 'patient.user'])
            ->where('id', $id)
            ->where('patient_id', $user->patient->id)
            ->firstOrFail();

        return view('patient.rendezvous-confirmation', compact('rendezVous'));
    }
}
