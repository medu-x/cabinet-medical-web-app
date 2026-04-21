<?php

namespace App\Http\Controllers;

use App\Models\DossierMedical;
use App\Models\Patient;
use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SecretaryController extends Controller
{
    public function dashboard()
    {
        $todayRendezVous = RendezVous::with(['patient.user', 'medecin.user', 'medecin.specialite'])
            ->whereDate('date_rendez_vous', today())
            ->orderBy('heure_rendez_vous')
            ->get();

        $waitingReservations = $todayRendezVous
            ->where('statut', 'en_attente')
            ->values();

        $inConsultationReservations = $todayRendezVous
            ->where('statut', 'confirmé')
            ->values();

        $closedReservations = $todayRendezVous
            ->filter(fn (RendezVous $rendezVous) => in_array($rendezVous->statut, ['annulé', 'annule', 'termine', 'terminé'], true))
            ->values();

        return view('secretary.dashboard', compact(
            'todayRendezVous',
            'waitingReservations',
            'inConsultationReservations',
            'closedReservations'
        ));
    }

    public function patients(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $patients = Patient::with('user')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('cin', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->get()
            ->sortBy(fn (Patient $patient) => $patient->user?->name ?? '')
            ->values();

        return view('secretary.patients', compact('patients', 'search'));
    }

    public function storePatient(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            'cin' => ['nullable', 'string', 'max:20', 'unique:patients,cin'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'date_naissance' => ['nullable', 'date', 'before:today'],
            'adresse' => ['nullable', 'string', 'max:255'],
        ]);

        $generatedEmail = $validated['email'] ?? null;

        if (! $generatedEmail) {
            $generatedEmail = sprintf(
                'patient.%s.%s@cabinet.local',
                now()->format('YmdHis'),
                Str::lower(Str::random(6))
            );
        }

        $patient = null;

        DB::transaction(function () use ($validated, $generatedEmail, &$patient) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $generatedEmail,
                'password' => Hash::make(Str::random(16)),
                'role' => 'patient',
            ]);

            $patient = Patient::create([
                'user_id' => $user->id,
                'cin' => $validated['cin'] ?? null,
                'telephone' => $validated['telephone'] ?? null,
                'adresse' => $validated['adresse'] ?? null,
                'date_naissance' => $validated['date_naissance'] ?? null,
            ]);

            DossierMedical::firstOrCreate([
                'patient_id' => $patient->id,
            ]);
        });

        $successMessage = $validated['email'] ?? null
            ? 'Le patient a été ajouté avec succès.'
            : 'Le patient a été ajouté avec succès. Un email interne a été généré automatiquement pour ce dossier.';

        return redirect()
            ->route('secretary.patients')
            ->with('success', $successMessage);
    }

    public function updateRendezVousStatus(Request $request, RendezVous $rendezVous)
    {
        $validated = $request->validate([
            'statut' => ['required', 'in:confirmé,annulé,termine'],
        ]);

        if ($rendezVous->date_rendez_vous !== today()->toDateString()) {
            return redirect()
                ->route('secretary.dashboard')
                ->with('error', 'Seuls les rendez-vous d\'aujourd\'hui peuvent être gérés depuis ce tableau de bord.');
        }

        $currentStatus = match ($rendezVous->statut) {
            'annule' => 'annulé',
            'terminé' => 'termine',
            default => $rendezVous->statut,
        };

        $allowedTransitions = [
            'en_attente' => ['confirmé', 'annulé'],
            'confirmé' => ['termine'],
        ];

        if (! in_array($validated['statut'], $allowedTransitions[$currentStatus] ?? [], true)) {
            return redirect()
                ->route('secretary.dashboard')
                ->with('error', 'Cette action n\'est pas autorisée pour le statut actuel du rendez-vous.');
        }

        $rendezVous->update([
            'statut' => $validated['statut'],
        ]);

        $successMessage = match ($validated['statut']) {
            'confirmé' => 'Le patient a été déplacé vers la liste des consultations.',
            'annulé' => 'Le patient a été marqué comme absent et retiré de la liste active.',
            'termine' => 'La consultation a été marquée comme terminée.',
        };

        return redirect()
            ->route('secretary.dashboard')
            ->with('success', $successMessage);
    }
}
