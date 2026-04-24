<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    public function showVerifyForm()
    {
        if (! session('verify_email')) {
            return redirect()->route('register');
        }

        return view('auth.verify-email');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $email = session('verify_email');

        if (! $email) {
            return redirect()->route('register')
                ->withErrors(['code' => 'Session expirée. Veuillez vous réinscrire.']);
        }

        $user = User::where('email', $email)->first();

        if (! $user || ! $user->email_verification_token) {
            return back()->withErrors(['code' => 'Aucun code trouvé. Recommencez.']);
        }

        [$storedCode, $expiry] = explode('|', $user->email_verification_token);

        if (now()->isAfter($expiry)) {
            $user->update(['email_verification_token' => null]);
            return back()->withErrors(['code' => 'Ce code a expiré. Demandez un nouveau code.']);
        }

        if ($request->code !== $storedCode) {
            return back()->withErrors(['code' => 'Code incorrect. Vérifiez votre email.']);
        }

        // Mark email as verified and clear token
        $user->update([
            'email_verified_at'        => now(),
            'email_verification_token' => null,
        ]);

        session()->forget('verify_email');

        // Log the user in and redirect to dashboard
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', 'Votre email a été vérifié avec succès. Bienvenue !');
    }

    public function resendCode()
    {
        $email = session('verify_email');

        if (! $email) {
            return redirect()->route('register')
                ->withErrors(['email' => 'Session expirée. Veuillez vous réinscrire.']);
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            return redirect()->route('register');
        }

        $code   = random_int(100000, 999999);
        $expiry = now()->addMinutes(10)->format('Y-m-d H:i:s');

        $user->update([
            'email_verification_token' => $code . '|' . $expiry,
        ]);

        Mail::to($user->email)->send(new EmailVerificationMail((string) $code, $user->name));

        return redirect()->route('email.verify.form')
            ->with('success', 'Un nouveau code a été envoyé à ' . $email);
    }
}
