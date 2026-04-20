<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RendezVousController;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
// added routes for the guest page
Route::get('/', function () {
    return View('guest.index');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::get('/dashboard', function () {
    $user = Auth::user();

    return match ($user->role) {
        'doctor' => redirect()->route('doctor.dashboard'),
        'secretary' => redirect()->route('secretary.dashboard'),
        'admin' => redirect()->route('admin.dashboard'),
        default => redirect()->route('patient.dashboard'),
    };
})->name('dashboard')->middleware('auth');

Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])
    ->name('patient.dashboard')
    ->middleware(['auth','role:patient']);

Route::get('/doctor/dashboard', function () {
    return view('doctor.dashboard');
})->name('doctor.dashboard')->middleware(['auth','role:doctor']);

Route::get('/secretary/dashboard', function () {
    return view('secritaire.dashboard');
})->name('secretary.dashboard')->middleware(['auth','role:secretary']);

//admine
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware(['auth','role:admin']);

Route::get('/admin/patients', function() {
    return view('admin.patients');
})->name('admin.patients')->middleware(['auth','role:admin']);

Route::get('/admin/secrataires', function() {
    return view('admin.secrataires');
})->name('admin.secrataires')->middleware(['auth','role:admin']);

Route::get('/admin/doctors', function() {
    return view('admin.doctors');
})->name('admin.doctors')->middleware(['auth','role:admin']);


// prend le rendez vous
Route::post('/rendez-vous', [RendezVousController::class, 'storeRendezVous'])
    ->name('rendezvous.store')
    ->middleware(['auth','role:patient']);

Route::get('/rendez-vous/{id}/confirmation', [RendezVousController::class, 'confirmation'])
    ->name('rendezvous.confirmation')
    ->middleware(['auth','role:patient']);

Route::get('/rendez-vous/{id}/pdf', [RendezVousController::class, 'downloadPdf'])
    ->name('rendezvous.pdf')
    ->middleware(['auth','role:patient']);
