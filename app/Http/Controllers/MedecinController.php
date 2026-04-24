<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DossierMedical;
use App\Models\Consultation;
use App\Models\Ordonnance;
use App\Models\RendezVous;
use Barryvdh\DomPDF\Facade\Pdf;

class MedecinController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();

        $rendezVousDuJourConfirmed = $user->medecin->rendezVousDuJourConfirmed();

        $activeRdvId = $request->query('rdv');

        $activeRdv = $activeRdvId
            ? $rendezVousDuJourConfirmed->firstWhere('id', $activeRdvId)
            : $rendezVousDuJourConfirmed->first();

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

        $dossier = DossierMedical::firstOrCreate(['patient_id' => $patientId]);
        $dossier->update($validated);

        return back()->with('success', 'Dossier médical mis à jour avec succès.');
    }

    public function storeConsultation(Request $request)
    {
        $validated = $request->validate([
            'rendez_vous_id'           => 'required|exists:rendez_vous,id',
            'motif'                    => 'required|string',
            'diagnostic'               => 'required|string',
            'notes'                    => 'nullable|string',
            'rapport_medical'          => 'required|string',
            'medicaments'              => 'nullable|array',
            'medicaments.*.medicament' => 'required_with:medicaments|string',
            'medicaments.*.dosage'     => 'required_with:medicaments|string',
            'medicaments.*.frequence'     => 'required_with:medicaments|string',
            'medicaments.*.instructions'  => 'nullable|string',
        ]);

        $user       = Auth::user();
        $rendezVous = RendezVous::findOrFail($validated['rendez_vous_id']);

        if (Consultation::where('rendez_vous_id', $rendezVous->id)->exists()) {
            return back()->with('error', 'Une consultation existe déjà pour ce rendez-vous.');
        }

        $consultation = Consultation::create([
            'rendez_vous_id'  => $rendezVous->id,
            'patient_id'      => $rendezVous->patient_id,
            'medecin_id'      => $user->medecin->id,
            'motif'           => $validated['motif'],
            'diagnostic'      => $validated['diagnostic'],
            'rapport_medical' => $validated['rapport_medical'] . (isset($validated['notes']) ? "\n\nNotes: " . $validated['notes'] : ''),
            'statut'          => 'termine',
        ]);

        $ordonnance = null;
        if (!empty($validated['medicaments'])) {
            $ordonnance = $consultation->ordonnances()->create([
                'date' => now()->toDateString(),
            ]);

            foreach ($validated['medicaments'] as $med) {
                $ordonnance->prescriptions()->create([
                    'medicament'   => $med['medicament'],
                    'dosage'       => $med['dosage'],
                    'frequence'    => $med['frequence'],
                    'instructions' => $med['instructions'] ?? null,
                ]);
            }
        }

        $rendezVous->update(['statut' => 'termine']);

        if ($ordonnance) {
            return redirect()->route('doctor.ordonnance.print', $ordonnance->id);
        }

        return back()->with('success_consultation', 'Consultation terminée et enregistrée avec succès !');
    }

    public function printOrdonnance($id)
    {
        $ordonnance = Ordonnance::with([
            'prescriptions',
            'consultation.patient.user',
            'consultation.medecin.user',
            'consultation.medecin.specialite',
        ])->findOrFail($id);

        $pdf = Pdf::loadView('doctor.ordonnance-print', compact('ordonnance'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('ordonnance-' . $ordonnance->id . '.pdf');
    }
}
