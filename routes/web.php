<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\MedecinController;
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

Route::get('/patient/mes-rendez-vous', [PatientController::class, 'rendezVousIndex'])
    ->name('patient.rendezvous.index')
    ->middleware(['auth','role:patient']);

Route::get('/patient/profil', [PatientController::class, 'profil'])
    ->name('patient.profil')
    ->middleware(['auth','role:patient']);



// Espace Secrétaire (UI routes)
Route::group(['prefix' => 'secretary', 'middleware' => ['auth', 'role:secretary']], function () {
    Route::get('/dashboard', function () {
        return view('secretary.dashboard');
    })->name('secretary.dashboard');

    Route::get('/patients', function () {
        return view('secretary.patients');
    })->name('secretary.patients');

    Route::get('/rendezvous', function () {
        return view('secretary.rendezvous');
    })->name('secretary.rendezvous');
});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard',   [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Patients
    Route::get('/patients',               [AdminController::class, 'patients'])->name('admin.patients');
    Route::post('/patients',              [AdminController::class, 'storePatient'])->name('admin.patients.store');
    Route::patch('/patients/{id}',        [AdminController::class, 'updatePatient'])->name('admin.patients.update');
    Route::delete('/patients/{id}',       [AdminController::class, 'destroyPatient'])->name('admin.patients.destroy');

    // Secrétaires
    Route::get('/secrataires',            [AdminController::class, 'secretaires'])->name('admin.secrataires');
    Route::post('/secrataires',           [AdminController::class, 'storeSecretaire'])->name('admin.secrataires.store');
    Route::patch('/secrataires/{id}',     [AdminController::class, 'updateSecretaire'])->name('admin.secrataires.update');
    Route::delete('/secrataires/{id}',    [AdminController::class, 'destroySecretaire'])->name('admin.secrataires.destroy');

    // Médecins
    Route::get('/doctors',                [AdminController::class, 'doctors'])->name('admin.doctors');
    Route::post('/doctors',               [AdminController::class, 'storeDoctor'])->name('admin.doctors.store');
    Route::patch('/doctors/{id}',         [AdminController::class, 'updateDoctor'])->name('admin.doctors.update');
    Route::delete('/doctors/{id}',        [AdminController::class, 'destroyDoctor'])->name('admin.doctors.destroy');

    // Patient detail
    Route::get('/patients/{id}/detail',   [AdminController::class, 'patientDetail'])->name('admin.patients.detail');
});






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



// Password reset (6-digit code flow)
Route::get('/forgot-password',  [PasswordResetController::class, 'showRequestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendCode'])->name('password.email');
Route::get('/resend-code',      [PasswordResetController::class, 'resendCode'])->name('password.resend');
Route::get('/verify-code',      [PasswordResetController::class, 'showVerifyForm'])->name('password.verify');
Route::post('/verify-code',     [PasswordResetController::class, 'verifyCode'])->name('password.verify.submit');
Route::get('/reset-password',   [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password',  [PasswordResetController::class, 'resetPassword'])->name('password.update');


// doctor space 

Route::get('/doctor/dashboard', [MedecinController::class, 'dashboard'])
    ->name('doctor.dashboard')
    ->middleware(['auth','role:doctor']);

Route::post('/doctor/consultation', [MedecinController::class, 'storeConsultation'])
    ->name('doctor.consultation.store')
    ->middleware(['auth','role:doctor']);

Route::patch('/doctor/dossier/{patientId}', [MedecinController::class, 'updateDossier'])
    ->name('doctor.dossier.update')
    ->middleware(['auth','role:doctor']);