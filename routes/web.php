<?php

use Illuminate\Support\Facades\Route;
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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', [PatientController::class, 'dashboard'])
    ->name('dashboard')
    ->middleware('auth');

Route::get('/doctor/dashboard', function () {
    return view('doctor.dashboard');
})->name('doctor.dashboard')->middleware('auth');

Route::get('/secretary/dashboard', function () {
    return view('secritaire.dashboard');
})->name('secretary.dashboard')->middleware('auth');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth');


// prend le rendez vous
Route::post('/rendez-vous', [RendezVousController::class, 'storeRendezVous'])
    ->name('rendezvous.store')
    ->middleware('auth');

Route::get('/rendez-vous/{id}/confirmation', [RendezVousController::class, 'confirmation'])
    ->name('rendezvous.confirmation')
    ->middleware('auth');

Route::get('/rendez-vous/{id}/pdf', [RendezVousController::class, 'downloadPdf'])
    ->name('rendezvous.pdf')
    ->middleware('auth');
