<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\PasswordResetController;
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

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware(['auth','role:admin']);


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
