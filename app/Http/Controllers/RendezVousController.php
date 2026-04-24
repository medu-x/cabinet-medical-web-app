<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationRendezVousMail;
use App\Models\Medecin;
use App\Models\Patient;
use App\Models\RendezVous;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class RendezVousController extends Controller
{
    public function secretaryIndex()
    {
        $rendezVous = RendezVous::with(['patient.user', 'medecin.user', 'medecin.specialite'])
            ->get()
            ->sortBy(function (RendezVous $rendezVous) {
                $appointmentDate = Carbon::parse($rendezVous->date_rendez_vous);
                $priority = $appointmentDate->lt(now()->startOfDay()) ? 1 : 0;

                return sprintf(
                    '%d_%s_%s',
                    $priority,
                    $rendezVous->date_rendez_vous,
                    $rendezVous->heure_rendez_vous
                );
            })
            ->values();

        $patients = Patient::with('user')
            ->get()
            ->sortBy(fn (Patient $patient) => $patient->user?->name ?? '')
            ->values();

        $medecins = Medecin::with(['user', 'specialite'])
            ->get()
            ->sortBy(fn (Medecin $medecin) => $medecin->user?->name ?? '')
            ->values();

        return view('secretary.rendezvous', compact('rendezVous', 'patients', 'medecins'));
    }

    public function secretaryStore(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'medecin_id' => ['required', 'exists:medecins,id'],
            'date_rendez_vous' => ['required', 'date'],
            'heure_rendez_vous' => ['required', 'date_format:H:i'],
            'statut' => ['required', 'in:en_attente,confirmé'],
        ]);

        $slotDateTime = Carbon::parse($validated['date_rendez_vous'] . ' ' . $validated['heure_rendez_vous']);

        if ($slotDateTime->lt(now()->startOfMinute())) {
            return back()
                ->withInput()
                ->withErrors([
                    'date_rendez_vous' => 'La date et l\'heure du rendez-vous doivent être dans le présent ou le futur.',
                ]);
        }

        $exists = RendezVous::where('medecin_id', $validated['medecin_id'])
            ->where('date_rendez_vous', $validated['date_rendez_vous'])
            ->where('heure_rendez_vous', $validated['heure_rendez_vous'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'heure_rendez_vous' => 'Ce créneau est déjà réservé pour ce médecin.',
                ]);
        }

        RendezVous::create($validated);

        return redirect()
            ->route('secretary.rendezvous')
            ->with('success', 'Le rendez-vous a été créé avec succès.');
    }

    public function storeRendezVous(Request $request)
    {
        $request->validate([
            'medecin_id' => ['required', 'exists:medecins,id'],
            'date_rendez_vous' => ['required', 'date'],
            'heure_rendez_vous' => ['required'],
        ]);

        $slotDateTime = \Carbon\Carbon::parse($request->date_rendez_vous . ' ' . $request->heure_rendez_vous);

        // Reject past or within 60-min slots
        if (now()->diffInMinutes($slotDateTime, false) < 60) {
            return back()->with('error', 'Impossible de réserver un créneau dans moins de 60 minutes ou dans le passé.');
        }

        // Reject weekends (Saturday and Sunday)
        $dayOfWeek = $slotDateTime->dayOfWeek; // 0=Sunday, 6=Saturday
        if ($dayOfWeek === 0 || $dayOfWeek === 6) {
            return back()->with('error', 'Le cabinet est fermé le week-end (samedi et dimanche).');
        }

        // Enforce working hours: 08:00–12:00 and 14:00–18:00
        $slotTime = $slotDateTime->format('H:i');
        $inMorning   = $slotTime >= '08:00' && $slotTime <= '11:30';
        $inAfternoon = $slotTime >= '14:00' && $slotTime <= '17:30';
        if (!$inMorning && !$inAfternoon) {
            return back()->with('error', 'Les rendez-vous sont disponibles de 08h00 à 12h00 et de 14h00 à 18h00, du lundi au vendredi.');
        }

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

        $rendezVous = RendezVous::with(['medecin.user', 'medecin.specialite', 'patient.user'])
            ->create([
                'patient_id' => $user->patient->id,
                'medecin_id' => $request->medecin_id,
                'date_rendez_vous' => $request->date_rendez_vous,
                'heure_rendez_vous' => $request->heure_rendez_vous,
                'statut' => 'en_attente',
            ]);

        Mail::to($user->email)->send(new ConfirmationRendezVousMail($rendezVous));

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

        return view('patient.confirmation', compact('rendezVous'));
    }
    public function downloadPdf($id)
    {
        $user = Auth::user();

        if (! $user->patient) {
            abort(403);
        }

        $rendezVous = RendezVous::with(['medecin.user', 'medecin.specialite', 'patient.user'])
            ->where('id', $id)
            ->where('patient_id', $user->patient->id)
            ->firstOrFail();

        $pdf = Pdf::loadView('patient.confirmation-pdf', compact('rendezVous'));

        return $pdf->download('rendez-vous-' . $rendezVous->id . '.pdf');
    }
}
