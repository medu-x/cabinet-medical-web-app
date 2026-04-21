<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $paidPatientsCount = Patient::count();
        $totalConsultations = RendezVous::count();

        return view('admin.dashboard', compact('paidPatientsCount', 'totalConsultations'));
    }
}
