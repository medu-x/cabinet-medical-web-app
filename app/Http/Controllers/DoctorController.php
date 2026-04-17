<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    // Dashboard: عرض جميع المواعيد ديال الطبيب
public function dashboard()
{
    $medecin = Medecin::with('rendezVous.patient')->where('user_id', Auth::id())->firstOrFail();

    // إحصائيات بسيطة
    $totalPatients = $medecin->rendezVous->count();
    $totalConsultations = $medecin->rendezVous->where('statut', 'terminé')->count();
    $waiting = $medecin->rendezVous->where('statut', 'en attente')->count();

    return view('doctor.dashboard', compact('medecin','totalPatients','totalConsultations','waiting'));
}



    // Consultation: إدخال compte-rendu للمريض

public function ordonnanceStore(Request $request, $rendezVousId)
{
    // نجيب الموعد مع المريض والطبيب
    $rendezVous = RendezVous::with('patient','medecin')->findOrFail($rendezVousId);

    // جلب البيانات من الفورم
    $diagnostic = $request->input('diagnostic'); // نوع المرض
    $prescriptions = $request->input('medicaments'); // جدول الأدوية

    // نبني النص ديال notes
    $notesArray = [];

    // التشخيص يكون أول عنصر
    if (!empty($diagnostic)) {
        $notesArray[] = "Diagnostic: ".$diagnostic;
    }

    // نضيف كل دواء
    foreach ($prescriptions as $prescription) {
        if (!empty($prescription['nom'])) {
            $notesArray[] = $prescription['nom'].' - '.$prescription['dosage'].' - '.$prescription['duree'].' - '.$prescription['remarques'];
        }
    }

    // نص واحد مفصول بـ "|"
    $notesString = implode(' | ', $notesArray);

    // نخزنها فـ rendezVous
    $rendezVous->notes = $notesString;
    $rendezVous->statut = 'terminé';
    $rendezVous->save();

    // توليد PDF باستعمال DomPDF
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

    // نفكك notes باش نجيب التشخيص والأدوية
    $diagnostic = null;
    $prescriptions = [];

    if (!empty($rendezVous->notes)) {
        $parts = explode(' | ', $rendezVous->notes);

        // أول عنصر هو التشخيص
        if (str_starts_with($parts[0], 'Diagnostic:')) {
            $diagnostic = str_replace('Diagnostic: ', '', $parts[0]);
            array_shift($parts);
        }

        // الباقي أدوية
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
    $rendezVousList = RendezVous::with('medecin','patient')
        ->where('patient_id', $patientId)
        ->whereNotNull('notes')
        ->orderBy('date_rendez_vous', 'desc')
        ->get();

    return view('doctor.ordonnance_history', compact('rendezVousList'));
}


}
