<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\RendezVous;
use App\Models\Medecin;
use App\Models\Secretaire;
use App\Models\Specialite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // ─── DASHBOARD ────────────────────────────────────────────────────────────

    public function dashboard(Request $request)
    {
        $availableYears = collect([2026, 2025]);

        $selectedYear = (int) $request->query('year', $availableYears->first());

        if (! $availableYears->contains($selectedYear)) {
            $selectedYear = $availableYears->first();
        }

        $paidPatientsCount = Patient::count();
        $totalConsultations = RendezVous::count();
        $totalRendezVous = RendezVous::count();
        $totalRendezVousAnnules = RendezVous::whereIn('statut', ['annulé', 'annule', 'annulÃ©'])->count();
        $newPatientsThisMonth = Patient::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        $rendezVousThisMonth = RendezVous::whereYear('date_rendez_vous', now()->year)
            ->whereMonth('date_rendez_vous', now()->month)
            ->count();

        $monthlyRendezVous = RendezVous::selectRaw('MONTH(date_rendez_vous) as month_number, COUNT(*) as total')
            ->whereYear('date_rendez_vous', $selectedYear)
            ->groupBy(DB::raw('MONTH(date_rendez_vous)'))
            ->pluck('total', 'month_number');

        $chartLabels = ['JAN', 'FEV', 'MAR', 'AVR', 'MAI', 'JUN', 'JUL', 'AOU', 'SEP', 'OCT', 'NOV', 'DEC'];
        $chartData = [];

        foreach (range(1, 12) as $monthNumber) {
            $chartData[] = (int) ($monthlyRendezVous[$monthNumber] ?? 0);
        }

        $demographyCounts = [
            '18_35' => 0,
            '36_60' => 0,
            '60_plus' => 0,
        ];

        $patientsWithBirthDate = Patient::whereNotNull('date_naissance')->pluck('date_naissance');

        foreach ($patientsWithBirthDate as $dateNaissance) {
            $age = \Carbon\Carbon::parse($dateNaissance)->age;

            if ($age >= 18 && $age <= 35) {
                $demographyCounts['18_35']++;
            } elseif ($age >= 36 && $age <= 60) {
                $demographyCounts['36_60']++;
            } elseif ($age > 60) {
                $demographyCounts['60_plus']++;
            }
        }

        $demographyData = [
            $demographyCounts['18_35'],
            $demographyCounts['36_60'],
            $demographyCounts['60_plus'],
        ];

        return view('admin.dashboard', compact(
            'paidPatientsCount',
            'totalConsultations',
            'totalRendezVous',
            'totalRendezVousAnnules',
            'newPatientsThisMonth',
            'rendezVousThisMonth',
            'availableYears',
            'selectedYear',
            'chartLabels',
            'chartData',
            'demographyData'
        ));
    }

    // ─── PATIENTS ─────────────────────────────────────────────────────────────

    public function patients()
    {
        $patients = Patient::with('user')->latest()->paginate(15);
        return view('admin.patients', compact('patients'));
    }

    public function destroyPatient($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->user()->delete(); // cascades to patient via onDelete('cascade')
        return redirect()->route('admin.patients')->with('success', 'Patient supprimé avec succès.');
    }

    public function updatePatient(Request $request, $id)
    {
        $patient = Patient::with('user')->findOrFail($id);

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $patient->user->id,
            'telephone' => 'nullable|string|max:20',
            'cin'       => 'nullable|string|max:20|unique:patients,cin,' . $patient->id,
        ]);

        $patient->user->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
        ]);

        $patient->update([
            'telephone' => $validated['telephone'],
            'cin'       => $validated['cin'],
        ]);

        return redirect()->route('admin.patients')->with('success', 'Patient modifié avec succès.');
    }

    // ─── SECRÉTAIRES ──────────────────────────────────────────────────────────

    public function secretaires()
    {
        $secretaires = Secretaire::with('user')->latest()->paginate(15);
        return view('admin.secrataires', compact('secretaires'));
    }

    public function destroySecretaire($id)
    {
        $secretaire = Secretaire::findOrFail($id);
        $secretaire->user()->delete(); // cascades to secretaire via onDelete('cascade')
        return redirect()->route('admin.secrataires')->with('success', 'Secrétaire supprimée avec succès.');
    }

    public function updateSecretaire(Request $request, $id)
    {
        $secretaire = Secretaire::with('user')->findOrFail($id);

        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $secretaire->user->id,
            'bureau' => 'required|in:A,B,C',
            'cin'    => 'required|string|max:20|unique:secretaires,cin,' . $secretaire->id,
        ]);

        $secretaire->user->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
        ]);

        $secretaire->update([
            'bureau' => $validated['bureau'],
            'cin'    => $validated['cin'],
        ]);

        return redirect()->route('admin.secrataires')->with('success', 'Secrétaire modifiée avec succès.');
    }

    // ─── MÉDECINS ─────────────────────────────────────────────────────────────

    public function doctors()
    {
        $medecins    = Medecin::with(['user', 'specialite'])->latest()->paginate(15);
        $specialites = Specialite::orderBy('nom')->get();
        return view('admin.doctors', compact('medecins', 'specialites'));
    }

    public function storeDoctor(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6',
            'specialite_id' => 'required|exists:specialites,id',
            'telephone'     => 'nullable|string|max:20',
            'cin'           => 'nullable|string|max:20|unique:medecins,cin',
            'experience'    => 'nullable|integer|min:0',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'doctor',
        ]);

        Medecin::create([
            'user_id'       => $user->id,
            'specialite_id' => $validated['specialite_id'],
            'telephone'     => $validated['telephone'] ?? null,
            'cin'           => $validated['cin'] ?? null,
            'experience'    => $validated['experience'] ?? 0,
            'bio'           => '',
        ]);

        return redirect()->route('admin.doctors')->with('success', 'Médecin ajouté avec succès.');
    }

    public function destroyDoctor($id)
    {
        $medecin = Medecin::findOrFail($id);
        $medecin->user()->delete(); // cascades to medecin via onDelete('cascade')
        return redirect()->route('admin.doctors')->with('success', 'Médecin supprimé avec succès.');
    }

    public function updateDoctor(Request $request, $id)
    {
        $medecin = Medecin::with('user')->findOrFail($id);

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $medecin->user->id,
            'specialite_id' => 'required|exists:specialites,id',
            'telephone'     => 'nullable|string|max:20',
            'cin'           => 'nullable|string|max:20|unique:medecins,cin,' . $medecin->id,
            'experience'    => 'nullable|integer|min:0',
        ]);

        $medecin->user->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
        ]);

        $medecin->update([
            'specialite_id' => $validated['specialite_id'],
            'telephone'     => $validated['telephone'],
            'cin'           => $validated['cin'],
            'experience'    => $validated['experience'] ?? $medecin->experience,
        ]);

        return redirect()->route('admin.doctors')->with('success', 'Médecin modifié avec succès.');
    }
}
