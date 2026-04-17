<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    // Dashboard: njib ga3 lmawa3id ttbib
public function dashboard()
{
    $medecin = Medecin::with('rendezVous.patient')->where('user_id', Auth::id())->firstOrFail();

    // إحصائيات بسيطة
    $totalPatients = $medecin->rendezVous->count();
    $totalConsultations = $medecin->rendezVous->where('statut', 'terminé')->count();
    $waiting = $medecin->rendezVous->where('statut', 'en attente')->count();

    return view('doctor.dashboard', compact('medecin','totalPatients','totalConsultations','waiting'));
}





public function ordonnanceStore(Request $request, $rendezVousId)
{
    // njib lmw3id m3a tbib wlmrid
    $rendezVous = RendezVous::with('patient','medecin')->findOrFail($rendezVousId);

    // njib lbayanat mn lform 
    $diagnostic = $request->input('diagnostic'); // no3 lmarad
    $prescriptions = $request->input('medicaments'); // tableau tladwiya


    // nbniw string notes
    $notesArray = [];

    // nchfofo wach kayn naw3 tlmarad
    if (!empty($diagnostic)) {
        $notesArray[] = "Diagnostic: ".$diagnostic;
    }

    // nzido ga3 dwyan
    foreach ($prescriptions as $prescription) {
        if (!empty($prescription['nom'])) {
            $notesArray[] = $prescription['nom'].' - '.$prescription['dosage'].' - '.$prescription['duree'].' - '.$prescription['remarques'];
        }
    }

    // nrj3oh string b separator |
    $notesString = implode(' | ', $notesArray);

    // n5znha f rendezVous
    $rendezVous->notes = $notesString;
    $rendezVous->statut = 'terminé';
    $rendezVous->save();

    // nsawb PDF
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('doctor.ordonnance', [
        'rendezVous' => $rendezVous,
        'diagnostic' => $diagnostic,
        'prescriptions' => $prescriptions
    ]);

    return $pdf->stream('ordonnance_'.$rendezVous->id.'.pdf');

}

public function ordonnancePdf($rendezVousId)
{
    $rendezVous = RendezVous::with('patient','medecin')->findOrFail($rendezVousId);

    // bach n9sm string wnjib lmarad wdwyan
    $diagnostic = null;
    $prescriptions = [];

    if (!empty($rendezVous->notes)) {
        $parts = explode(' | ', $rendezVous->notes);

        // now3 tlmarad
        if (str_starts_with($parts[0], 'Diagnostic:')) {
            $diagnostic = str_replace('Diagnostic: ', '', $parts[0]);
            array_shift($parts);
        }

        // dwyan
        foreach ($parts as $p) {
            $fields = explode(' - ', $p);
            $prescriptions[] = [
                'nom' => $fields[0] ?? '',
                'dosage' => $fields[1] ?? '',
                'duree' => $fields[2] ?? '',
                'remarques' => $fields[3] ?? ''
            ];
        }
    }

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('doctor.ordonnance', [
        'rendezVous' => $rendezVous,
        'diagnostic' => $diagnostic,
        'prescriptions' => $prescriptions
    ]);
    return $pdf->stream('ordonnance_'.$rendezVous->id.'.pdf');

}

public function ordonnanceForm($rendezVousId)
{
    $rendezVous = RendezVous::with('patient','medecin')->findOrFail($rendezVousId);
    return view('doctor.ordonnance_form', compact('rendezVous'));
}

public function ordonnanceHistory($patientId)
{
    // نجيب جميع المواعيد ديال هاد المريض اللي فيهم وصفة
    // njib ga3 lmawa3id ta3 lmrid lidrna lihom ordonnancePDF 
    $rendezVousList = RendezVous::with('medecin','patient')
        ->where('patient_id', $patientId)
        ->whereNotNull('notes')
        ->orderBy('date_rendez_vous', 'desc')
        ->get();

    return view('doctor.ordonnance_history', compact('rendezVousList'));
}


}
