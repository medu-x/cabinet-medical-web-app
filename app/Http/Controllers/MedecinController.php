<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DossierMedical;
use App\Models\Consultation;
use App\Models\RendezVous;

class MedecinController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();

        $rendezVousDuJourConfirmed = $user->medecin->rendezVousDuJourConfirmed();

        // RDV actif : depuis ?rdv= dans l'URL, sinon le premier de la file
        $activeRdvId = $request->query('rdv');

        $activeRdv = $activeRdvId
            ? $rendezVousDuJourConfirmed->firstWhere('id', $activeRdvId)
            : $rendezVousDuJourConfirmed->first();

        // Charger le dossier médical du patient actif si disponible
        if ($activeRdv) {
            $activeRdv->patient->load('dossierMedical');
        }

        return view('doctor.dashboard', compact('user', 'rendezVousDuJourConfirmed', 'activeRdv'));
    }

    public function updateDossier(Request $request, $patientId)
    {
        $validated = $request->validate([
            'groupe_sanguin' => 'nullable|string|max:10',
            'allergies'      => 'nullable|string',
            'antecedents'    => 'nullable|string',
        ]);

        // firstOrCreate guarantees that if a dossier doesn't exist, it makes an empty one first!
        $dossier = DossierMedical::firstOrCreate(['patient_id' => $patientId]);
        $dossier->update($validated);

        return back()->with('success', 'Dossier médical mis à jour avec succès.');
    }

    public function storeConsultation(Request $request)
    {
        $validated = $request->validate([
            'rendez_vous_id' => 'required|exists:rendez_vous,id',
            'motif' => 'required|string',
            'diagnostic' => 'required|string',
            'notes' => 'nullable|string',
            'rapport_medical' => 'required|string',
            'medicaments' => 'nullable|array',
            'medicaments.*.medicament' => 'required_with:medicaments|string',
            'medicaments.*.posologie' => 'required_with:medicaments|string',
            'medicaments.*.frequence' => 'required_with:medicaments|string',
            'medicaments.*.notes' => 'nullable|string',
        ]);

        $user = Auth::user();
        $rendezVous = RendezVous::findOrFail($validated['rendez_vous_id']);

        // Check if a consultation already exists for this RDV
        if (Consultation::where('rendez_vous_id', $rendezVous->id)->exists()) {
            return back()->with('error', 'Une consultation existe déjà pour ce rendez-vous.');
        }

        // 1. Create Consultation
        $consultation = Consultation::create([
            'rendez_vous_id' => $rendezVous->id,
            'patient_id' => $rendezVous->patient_id,
            'medecin_id' => $user->medecin->id,
            'motif' => $validated['motif'],
            'diagnostic' => $validated['diagnostic'],
            'rapport_medical' => $validated['rapport_medical'] . "\n\nNotes de consultation: " . ($validated['notes'] ?? ''),
            'statut' => 'termine'
        ]);

        // 2. Create Ordonnances if any medicaments added
        if (!empty($validated['medicaments'])) {
            foreach ($validated['medicaments'] as $med) {
                $consultation->ordonnances()->create([
                    'medicament' => $med['medicament'],
                    'posologie' => $med['posologie'],
                    'frequence' => $med['frequence'],
                    'notes' => $med['notes'] ?? null,
                ]);
            }
        }

        // 3. Update RendezVous Status
        $rendezVous->update(['statut' => 'termine']);

        return back()->with('success_consultation', 'Consultation terminée et enregistrée avec succès !');
    }
}
