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

class AdminController extends Controller
{
    // ─── DASHBOARD ────────────────────────────────────────────────────────────

    public function dashboard()
    {
        $paidPatientsCount  = Patient::count();
        $totalConsultations = RendezVous::count();

        return view('admin.dashboard', compact('paidPatientsCount', 'totalConsultations'));
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
