<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\RendezVous;
use App\Models\Consultation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $paidPatientsCount = Patient::count();
        $totalConsultations = RendezVous::count();

        return view('admin.dashboard', compact('paidPatientsCount', 'totalConsultations'));
    }

    public function patients()
    {
        $patients = Patient::with('user')->with(['consultations' => function($query) {
            $query->latest('created_at');
        }])->paginate(10);

        return view('admin.patients', compact('patients'));
    }
}
